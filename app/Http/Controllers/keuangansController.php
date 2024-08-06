<?php

namespace App\Http\Controllers;

use App\Models\keuangan;
use Illuminate\Http\Request;

class keuangansController extends Controller
{
    public function index()
    {
        $data['catatans'] = keuangan::all();
        return view('admin.keuangan.index')->with($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
        ]);
        keuangan::create($request->all());
        return redirect('record')->with('success', 'catatan di tambahkan');
    }

    public function edit($id, Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = [
            'nominal' => $request->nominal,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
        ];

        keuangan::where('id', $id)->update($data);
        return redirect('record')->with('success', 'catatan berhasil di edit');
    }
}
