<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class kategoriController extends Controller
{
    public function index()
    {
        $data['kategoris'] = kategori::with('produk')->get();
        return view('admin.kategori.index')->with($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/kategori'), $filename);
            kategori::create([
                'name' => $request->name,
                'image' => $filename,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        return redirect('kategori')->with('success', 'Data Kategori Berhasil di Tambahkan');
    }

    public function edit(Request $request, $id)
    {
        kategori::find($id)->update($request->all());
        return redirect('kategori')->with('success', 'Data Kategori Berhasil di Update');
    }

    public function terkait($id)
    {
        $data['kategoris'] = kategori::with('produk')->find($id);
        return view('kategori.prodterkait')->with($data);
    }

    public function delete($id)
    {
        // hapus semua produk berdasarkan kategori
        $data = Produk::where('kategori_id', $id)->get();
        foreach ($data as $key => $value) {
            File::delete(public_path('images/produk/' . $value->image));
            $value->delete();
        }

        // hapus gambar kategori
        $data = kategori::find($id);
        File::delete(public_path('images/kategori/' . $data->image));

        // hapus kategori        
        kategori::find($id)->delete();
        return redirect('kategori')->with('success', 'Data Kategori Berhasil di Hapus');
    }
}
