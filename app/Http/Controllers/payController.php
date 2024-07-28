<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\Order;
use App\Models\pay;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class payController extends Controller
{
    // mengirim data pembayaran
    public function pay($id, Request $request)
    {
        $request->validate([
            'noHP' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // menambil semua data order sesuai invoice
        $order = Order::where('idInvoice', $id)->get();

        // pengecekan apabila barang yang mau di bayar terlanjur di bayar oleh orang lain
        foreach ($order as $item) {
            if ($item->produk->kategori->jenis == 'sewa') {
                if($item->produk->status == 'maintenance'){
                    return redirect('panding')->with('error', 'Mohon maaf ' . $item->produk->nama . ' sedang dalam maintenance ');
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
                        return redirect('panding')->with('error', 'kamu terlambat' . $item->produk->nama . ' telah di sewa pada ' . $rental->dari_tgl . ' sampai ' . $rental->sampai_tgl . '');
                    }
                }

                // Pengecekan pada history
                foreach ($histories as $rental) {
                    if ($this->checkDateConflict($item, $rental)) {
                        return redirect('panding')->with('error', ' kamu terlambat' . $item->produk->nama . ' telah di sewa pada ' . $rental->dari_tgl . ' sampai ' . $rental->sampai_tgl . '');
                    }
                }
            }
        }

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/payment'), $filename);
            $data = [
                'order_id' => $id,
                'noHP' => $request->noHP,
                'foto' => $filename,
            ];
        }

        Order::where('idInvoice', $id)->update([
            'status' => 'paid',
        ]);
        
        pay::create($data);
        
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);
        
        $message = $twilio->messages
            ->create(
                "whatsapp:+6281220786387", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => 'Ada Pembayaran Baru dengan id ' . $id
                )
            );
        
        return redirect('/')->with('success', 'Pembayaran Berhasil di terkirim');
    }

    // fungsi pengecekan
    private function checkDateConflict($item, $rental)
    {
        return (
            ($rental->dari_tgl <= $item->dari_tgl && $rental->sampai_tgl >= $item->dari_tgl) ||
            ($item->dari_tgl <= $rental->dari_tgl && $item->sampai_tgl >= $rental->dari_tgl && $item->sampai_tgl <= $rental->sampai_tgl)
        );
    }
}
