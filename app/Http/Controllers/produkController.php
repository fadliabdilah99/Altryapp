<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class produkController extends Controller
{
    public function index()
    {
        $data['kategoris'] = kategori::all();
        $data['produks'] = produk::all();
        return view('admin.product.index')->with($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/produk'), $filename);
            produk::create([
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'image' => $filename,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        return redirect('produk')->with('success', 'Data Produk Berhasil ditambahkan');
    }

    public function delete($id)
    {
        $data = produk::find($id);
        File::delete(public_path('images/produk/' . $data->image));
        $data->delete();
        return redirect('produk')->with('success', 'Data Berhasilsil Dihapus');
    }

    public function maintenance($id)
    {
        $data = produk::find($id);
        if ($data->status == 'siap') {
            $data->update([
                'status' => 'maintenance',
            ]);
            return redirect('produk')->with('success', 'produk telah di hentikan');
        }elseif($data->status == 'maintenance'){
            $data->update([
                'status' => 'siap',
            ]);
            return redirect('produk')->with('success', 'produk telah di pulihkan');
        }
    }
}
