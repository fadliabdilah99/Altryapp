<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\history;
use App\Models\keuangan;
use App\Models\Order;
use App\Models\pay;
use App\Models\payment;
use App\Models\Produk;
use App\Models\wallet;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class orderController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------------------------
    // ------------------------------------------------------admin page------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------------------------
    public function admin()
    {
        $invoices = Order::groupBy('idInvoice')
            ->select('idInvoice', DB::raw('MIN(id) as min_id'))
            ->get()
            ->pluck('min_id');
        $data['paid'] = Order::whereIn('id', $invoices)->where('status', 'paid')->get();
        $data['pending'] = Order::whereIn('id', $invoices)->where('status', 'pending')->get();

        return view('admin.order.index')->with($data);
    }

    // delete order
    public function delete(Request $request)
    {
        $id = $request->id;
        $orders = Order::where('idInvoice', $id)->get();
        foreach ($orders as $order) {
            $data = [
                'idInvoice' => $order->idInvoice,
                'user_id' => $order->user_id,
                'produk_id' => $order->produk_id,
                'dari_tgl' => $order->dari_tgl,
                'sampai_tgl' => $order->sampai_tgl,
                'status' => 'tolak',
                'totalHarga' => $order->totalHarga,
                'qty' => $order->qty,
            ];
            history::create($data);
        }

        $order->delete();
        return redirect('order-page')->with('success', 'Data Order Berhasil di tolak');
    }














    // -----------------------------------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------------------------
    // ------------------------------------------------------user page--------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------------------------
    public function index($id)
    {
        $data['cartsCount'] = cart::where('user_id', Auth::check() == true ? Auth::user()->id : null)->get()->count();
        $data['produks'] = Produk::where('kategori_id', $id)->with('kategori')->get();
        $data['name'] = $data['produks'][0]->kategori->name;
        return view('order.index')->with($data);
    }

    public function createCart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'produk_id' => 'required',
            'user_id' => 'required',
            'qty' => 'required',
        ]);

        cart::create($request->all());
        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    // cart page order controller-----------------------------------------------
    public function cart()
    {
        $data['carts'] = cart::where('user_id', Auth::check() == true ? Auth::user()->id : null)->with('produk')->get();
        return view('order.cart.index')->with($data);
    }

    // daftartanggal item yang sudah tersewa--------------------------------------
    public function daftartanggal($id, Request $request)
    {
        // dd($request->all());
        if (!empty($request->input('bulan'))) {
            $data['bulan'] = $request->input('bulan');
            $data['tahun'] = $request->input('tahun');
        } else {
            $data['bulan'] = Carbon::now()->format('m');
            $data['tahun'] = Carbon::now()->format('Y');
        }
        // fungsi ini untuk menampilkan daftar tanggal barang yang sudah di booking
        $data['tersewa'] = history::select('dari_tgl', 'sampai_tgl')
            ->where('status', 'proses')
            ->where('produk_id', $id)
            ->whereYear('dari_tgl', $data['tahun'])
            ->whereMonth('dari_tgl', $data['bulan'])
            ->get()
            ->map(function ($item) {
                $item->dari_tgl = Carbon::parse($item->dari_tgl)->format('d');
                $item->sampai_tgl = Carbon::parse($item->sampai_tgl)->format('d');
                return $item;
            });

        $data['order'] = Order::select('dari_tgl', 'sampai_tgl')
            ->where('status', 'paid')
            ->where('produk_id', $id)
            ->whereYear('dari_tgl', $data['tahun'])
            ->whereMonth('dari_tgl', $data['bulan'])
            ->get()
            ->map(function ($item) {
                $item->dari_tgl = Carbon::parse($item->dari_tgl)->format('d');
                $item->sampai_tgl = Carbon::parse($item->sampai_tgl)->format('d');
                return $item;
            });

        $data['merged'] = $data['tersewa']->concat($data['order']);
        $data['id'] = $id;
        $data['kategori_id'] = Produk::where('id', $id)->first()->kategori->id;
        return view('order.cart.daftartanggal')->with($data);
    }




    public function invoice($id)
    {
        // Cek apakah data ada di Order
        $data['orders'] = Order::where('idInvoice', $id)->get();
        $data['invoicedetail'] = Order::where('idInvoice', $id)->first();

        // Jika tidak ada di Order, cek di history
        if ($data['orders']->isEmpty() || $data['invoicedetail'] == null) {
            $data['orders'] = history::where('idInvoice', $id)->get();
            $data['invoicedetail'] = history::where('idInvoice', $id)->first();
        }

        // Jika tetap tidak ditemukan, kembalikan error atau handle sesuai kebutuhan
        if ($data['orders']->isEmpty() || $data['invoicedetail'] == null) {
            return abort(404, 'Invoice not found');
        }

        // Data untuk harga
        $data['subtotal'] = $data['orders']->sum('totalHarga');
        $data['ppn'] = $data['subtotal'] * 0.11;
        $data['admin'] = $data['subtotal'] * 0.01;
        $data['total'] = $data['subtotal'] + $data['ppn'] + $data['admin'];

        // id Invoice
        $data['id'] = $id;

        // Memanggil foto untuk admin page
        $pay = pay::select('foto')->where('order_id', $id)->first();
        if (!empty($pay)) {
            $data['pay'] = $pay;
        }

        return view('order.invoice.index')->with($data);
    }



    // checkout function order controller-----------------------------------------------
    public function checkout(Request $request)
    {
        // menerima input
        $cartIds = $request->input('cart_ids');
        $qty = $request->input('qty');
        $qty = array_map('intval', $qty);
        $produkIds = $request->input('produk_id');
        $prices = $request->input('price');
        $dari_tgl = $request->input('dari_tgl');
        $idInvoice =   random_int(1000000, 9999999);
        // Validasi input


        // proses validasi apabila tidak ada barang yang dipilih
        if (empty($cartIds)) {
            return redirect()->back()->with('error', 'Tidak ada item yang dipilih.');
        }


        $uniqueProductIds = [];
        foreach ($cartIds as $ids) {
            $prod = Produk::find($produkIds[$ids]);
            $history = history::where('status', 'proses')
                ->where('produk_id', $produkIds[$ids])
                ->get();
            $order = Order::where('status', 'paid')
                ->where('produk_id', $produkIds[$ids])
                ->first();


            if ($prod->kategori->jenis == 'sewa') {
                $productId = $produkIds[$ids];

                // pengecekan apabila mencheck out 2 barang yang sama
                if (in_array($productId, $uniqueProductIds)) {
                    return redirect()->back()->with('error', 'item serupa tidak Dapat Di Pilih duakali, silahkan checkout kembali jika ingin booking item tersebut di tanggal yang berbeda.');
                }
                $uniqueProductIds[] = $productId;

                // proses pengecekan apabila barang yang di sewa sudah di sewa
                $proses = Order::where('status', 'paid')
                    ->where('produk_id', $produkIds[$ids])
                    ->get();
                $sampai_tgl =  Carbon::parse($dari_tgl[$ids])->addDay($qty[$ids])->toDateString();
                foreach ($proses as $tersewa) {
                    if ($tersewa->dari_tgl <= $dari_tgl[$ids] && $tersewa->sampai_tgl >= $dari_tgl[$ids]) {
                        return back()->with('error', '' . $prod->nama . ' telah di sewa pada ' . $tersewa->dari_tgl . ' sampai ' . $tersewa->sampai_tgl . '');
                    } elseif ($dari_tgl[$ids] <= $tersewa->dari_tgl && $sampai_tgl >= $tersewa->dari_tgl && $sampai_tgl <= $tersewa->sampai_tgl) {
                        return back()->with('error', '' . $prod->nama . ' telah di sewa pada ' . $tersewa->dari_tgl . ' sampai ' . $tersewa->sampai_tgl . '');
                    }
                }
                $proses = $history;
                foreach ($proses as $tersewa) {
                    if ($tersewa->dari_tgl <= $dari_tgl[$ids] && $tersewa->sampai_tgl >= $dari_tgl[$ids]) {
                        return back()->with('error', '' . $prod->nama . ' telah di sewa pada ' . $tersewa->dari_tgl . ' sampai ' . $tersewa->sampai_tgl . '');
                    } elseif ($dari_tgl[$ids] <= $tersewa->dari_tgl && $sampai_tgl >= $tersewa->dari_tgl && $sampai_tgl <= $tersewa->sampai_tgl) {
                        return back()->with('error', '' . $prod->nama . ' telah di sewa pada ' . $tersewa->dari_tgl . ' sampai ' . $tersewa->sampai_tgl . '');
                    }
                }
            }
        }


        // proses memasukan data apabila item lolos dari validasi
        foreach ($cartIds as $cartId) {
            $order = [
                'idInvoice' => $idInvoice,
                'produk_id' => $produkIds[$cartId],
                'user_id' => Auth::user()->id,
                'qty' => $qty[$cartId],
                'totalHarga' => $qty[$cartId] * $prices[$cartId],
                'tenggat' => Carbon::now(),
            ];


            // Menambahkan jangka waktu bila produk sewa
            if (Produk::find($produkIds[$cartId])->kategori->jenis == 'sewa') {
                $order['dari_tgl'] = $dari_tgl[$cartId];
                $order['sampai_tgl'] = $sampai_tgl;
            }

            Order::create($order);


            // Hapus item dari cart
            Cart::find($cartId)->delete();
        }

        return redirect('invoicePanding/' . $idInvoice);
    }

    // panding order controller-----------------------------------------------
    public function panding()
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        $invoices = Order::where('user_id', $userId)
            ->groupBy('idInvoice')
            ->select('idInvoice', DB::raw('MIN(id) as min_id'))
            ->get()
            ->pluck('min_id');

        $data['invoices'] = Order::whereIn('id', $invoices)->get();

        return view('order.panding.index')->with($data);
    }
    // invoice print & pdf controller-----------------------------------------------

    public function downloadInvoicePDF($id)
    {
        // Cek apakah data ada di Order
        $orders = Order::where('idInvoice', $id)->get();
        $invoicedetail = Order::where('idInvoice', $id)->first();

        // Jika tidak ada di Order, cek di history
        if ($orders->isEmpty() || $invoicedetail == null) {
            $orders = history::where('idInvoice', $id)->get();
            $invoicedetail = history::where('idInvoice', $id)->first();
        }

        $subtotal = $orders->sum('totalHarga');
        $ppn = $subtotal * 0.11;
        $admin = $subtotal * 0.01;
        $total = $subtotal + $ppn + $admin;

        // Data yang akan dikirim ke view
        $data = [
            'orders' => $orders,
            'invoicedetail' => $invoicedetail,
            'id' => $id,
            'subtotal' => $subtotal,
            'ppn' => $ppn,
            'admin' => $admin,
            'total' => $total,
        ];

        // Render view dengan data
        $pdf = Pdf::loadView('order.invoice.pdf', $data);

        // Unduh file PDF
        return $pdf->download('invoice_' . $id . '.pdf');
    }
    public function print($id)
    {
        // mengambil data order
        $data['orders'] = Order::where('idInvoice', $id)->get();
        $data['invoicedetail'] = Order::where('idInvoice', $id)->first();

        // Jika tidak ada di Order, cek di history
        if ($data['orders']->isEmpty() || $data['invoicedetail'] == null) {
            $data['orders'] = history::where('idInvoice', $id)->get();
            $data['invoicedetail'] = history::where('idInvoice', $id)->first();
        }

        // Jika tetap tidak ditemukan, kembalikan error atau handle sesuai kebutuhan
        if ($data['orders']->isEmpty() || $data['invoicedetail'] == null) {
            return abort(404, 'Invoice not found');
        }

        // data untuk harga
        $data['subtotal'] = $data['orders']->sum('totalHarga');
        $data['ppn'] = $data['subtotal'] * 0.11;
        $data['admin'] = $data['subtotal'] * 0.01;
        $data['total'] = $data['subtotal'] + $data['ppn'] + $data['admin'];

        // id Invoice
        $data['id'] = $id;
        return view('order.invoice.invoice-print')->with($data);
    }


    // refund functiom
    public function refund($id, Request $request)   
    {
        $orders = history::where('idInvoice', $request->id)->get();
        foreach ($orders as $order) {
            if($id == 2){
                $refaund = 0.9;
            }else if($id == 1){
                $refaund = 1.1;
            }
            $data = [
                'user_id' => $order->user_id,
                'amount' => $order->totalHarga * $refaund,
                'deskripsi' => 'pengembalian dari order ' . $order->idInvoice,
            ];
            wallet::create($data);
        }
        history::where('idInvoice', $request->id)->update([
            'status' => 'refund',
        ]);
        return redirect()->back()->with('success', 'Data Order Berhasil di refund');
    }
}
