<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function user()
    {
        $data['users'] = User::get();
        // dd($data);
        return view('admin.user.index')->with($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect('user')->with('success', 'Data Berhasilsil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        user::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect('user')->with('success', 'Data Berhasilsil Diubah');
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('user')->with('success', 'Data Berhasilsil Dihapus');
    }
}
