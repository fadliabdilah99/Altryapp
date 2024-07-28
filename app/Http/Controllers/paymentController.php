<?php

namespace App\Http\Controllers;

use App\Models\history;
use Illuminate\Http\Request;

use App\Models\mindtrans;
use App\Models\Order;
use App\Models\payment;
use App\Models\pdua;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class paymentController extends Controller
{


    protected $response = [];

    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }



    private function checkDateConflict($item, $rental)
    {
        return (
            ($rental->dari_tgl <= $item->dari_tgl && $rental->sampai_tgl >= $item->dari_tgl) ||
            ($item->dari_tgl <= $rental->dari_tgl && $item->sampai_tgl >= $rental->dari_tgl && $item->sampai_tgl <= $rental->sampai_tgl)
        );
    }

  

    public function store(Request $request)
    {
        $order = Order::where('idInvoice', $request->invoice_code)->get();

        // Pengecekan apabila barang yang mau dibayar terlanjur dibayar oleh orang lain
        foreach ($order as $item) {
            if ($item->produk->kategori->jenis == 'sewa') {
                if ($item->produk->status == 'maintenance') {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Mohon maaf ' . $item->produk->nama . ' sedang dalam maintenance'
                    ]);
                }

                // Mengambil data pesanan dan history 
                $orders = Order::where('status', 'paid')
                    ->where('produk_id', $item->produk_id)
                    ->get();
                $histories = history::where('produk_id', $item->produk_id)
                    ->get();

                // Pengecekan pada tb order
                foreach ($orders as $rental) {
                    if ($this->checkDateConflict($item, $rental)) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Kamu terlambat, ' . $item->produk->nama . ' telah disewa pada ' . $rental->dari_tgl . ' sampai ' . $rental->sampai_tgl
                        ]);
                    }
                }

                // Pengecekan pada history
                foreach ($histories as $rental) {
                    if ($this->checkDateConflict($item, $rental)) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Kamu terlambat, ' . $item->produk->nama . ' telah disewa pada ' . $rental->dari_tgl . ' sampai ' . $rental->sampai_tgl
                        ]);
                    }
                }
            }
        }

        DB::transaction(function () use ($request) {
            $donation = payment::create([
                'invoice_code' => $request->invoice_code,
                'user_id' => $request->user_id,
                'email' => $request->email,
                'type' => $request->type,
                'amount' => floatval($request->amount),
                'note' => $request->note,
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id'      => $donation->invoice_code,
                    'gross_amount'  => $donation->amount,
                ],
                'customer_details' => [
                    'first_name'    => 'user' . $donation->user_id,
                    'email'         => $donation->email,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $donation->invoice_code,
                        'price'    => $donation->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $donation->type)),
                    ]
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
    }



    public function notification(Request $request)
    {
        // Menerima payload notifikasi dari Midtrans
        $payload = $request->getContent();

        // Log payload notifikasi
        Log::info('Midtrans Notification Received:');
        Log::info($payload);

        // Parsing payload JSON
        $notification = json_decode($payload);

        // Mendapatkan data yang relevan dari notifikasi
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Temukan donasi berdasarkan ID pesanan
        $donation = payment::where('invoice_code', $orderId)->first();
        $order = Order::where('idInvoice', $orderId)->get();

        // $Nomor = $donation->No;
        // $undangan_id = $donation->undangan_id;
        // $pdua = history::where('id', $undangan_id)->first();


        // Jika donasi tidak ditemukan, log pesan dan kembalikan respons
        if (!$donation) {
            LOG::error('Donation with order ID ' . $orderId . ' not found.');
            return response('Donation not found.', 404);
        }

        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {

                if ($fraudStatus == 'challenge') {
                    $donation->setStatusPending();
                } else {
                    foreach ($order as $item) {
                        $data = [
                            'idInvoice' => $item->idInvoice,
                            'user_id' => $item->user_id,
                            'produk_id' => $item->produk_id,
                            'dari_tgl' => $item->dari_tgl,
                            'sampai_tgl' => $item->sampai_tgl,
                            'status' => 'proses',
                        ];
                        history::create($data);
                        $item->delete();
                    }
                    payment::where('invoice_code', $orderId)->delete();
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            foreach ($order as $item) {
                $data = [
                    'idInvoice' => $item->idInvoice,
                    'user_id' => $item->user_id,
                    'produk_id' => $item->produk_id,
                    'dari_tgl' => $item->dari_tgl,
                    'sampai_tgl' => $item->sampai_tgl,
                    'status' => 'proses',
                ];
                history::create($data);
                $item->delete();
            }
            payment::where('invoice_code', $orderId)->delete();
        } elseif ($transactionStatus == 'pending') {

            $donation->setStatusPending();
        } elseif ($transactionStatus == 'deny') {

            $donation->setStatusFailed();
        } elseif ($transactionStatus == 'expire') {

            $donation->setStatusExpired();
        } elseif ($transactionStatus == 'cancel') {

            $donation->setStatusFailed();
        }

        // Kembalikan respons OK jika proses berhasil
        return response('Notification processed.', 200);
    }
}
