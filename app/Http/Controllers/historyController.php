<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class historyController extends Controller
{


    //admin page history-----------------------------------------------------------


    // menampilkan page admin
    public function indexAdmin()
    {
        $invoices = history::groupBy('idInvoice')
            ->with('user')
            ->select('idInvoice', DB::raw('MIN(id) as min_id'))
            ->get()
            ->pluck('min_id');
        $data['historys'] = history::whereIn('id', $invoices)->get();


        return view('admin.history.index')->with($data);
    }


    // konfirmasi selesai jika barang sewaan telah selesai
    public function doneOrder($id)
    {

        $data = history::where('idInvoice', $id)->get();
        foreach ($data as $item) {
            $item->status = 'selesai';
            $item->save();
        }
        return redirect('admin/history');
    }


    //user page history-----------------------------------------------------------


    // menampilkan page user
    public function indexUser()
    {
        $invoices = history::where('user_id', Auth::check() == true ? Auth::user()->id : null)
            ->groupBy('idInvoice')
            ->select('idInvoice', DB::raw('MIN(id) as min_id'))
            ->get()
            ->pluck('min_id');
        $data['history'] = history::whereIn('id', $invoices)->get();


        return view('history.index')->with($data);
    }

    // 
}
