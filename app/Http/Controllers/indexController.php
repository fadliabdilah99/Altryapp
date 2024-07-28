<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\history;
use App\Models\Kategori;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    // fungsi index admin
    public function index()
    {
        return view('admin.index');
    }

    //---------------------------------

    // fungsi index User
    public function home()
    {
        // jumlah invoice belum di bayar
        $data['invoicesCount'] = Order::where('user_id', Auth::check() == true ? Auth::user()->id : null)
            ->groupBy('idInvoice')
            ->select('idInvoice', DB::raw('MIN(id) as min_id'))
            ->pluck('min_id')
            ->count();
        // jumlah data cart
        $data['cartsCount'] = cart::where('user_id', Auth::check() == true ? Auth::user()->id : null)->get()->count();
        // jumlah data yang sudah selesai pembayaran
        $data['doneOrder'] = history::where('user_id', Auth::check() == true ? Auth::user()->id : null)
            ->groupBy('idInvoice')
            ->select('idInvoice', DB::raw('MIN(id) as min_id'))
            ->pluck('min_id')
            ->count();
        $data['kategoris'] = Kategori::all();
        return view('home.index')->with($data);
    }
}
