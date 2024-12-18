<?php

namespace App\Http\Controllers\Grosir;

use App\Http\Controllers\Controller;
use App\Models\Grosir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrosirProfileController extends Controller
{
    public function index() {
      $grosir = Grosir::where('id_user', Auth::user()->id)->first();
      return view('grosir.profile', compact('grosir'));
    }

    public function update(Request $request) {

      $request->validate([
        'foto_grosir' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'nama_grosir' => 'required|string|max:255',
        'alamat_grosir' => 'nullable|string|max:255',
        'nomor_telefon_grosir' => 'nullable|string|max:20',
        'username' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
      ]);

      $grosir = Grosir::where('id_user', Auth::user()->id)->first();
      $user = Auth::user();

      if ($request->hasFile('foto_grosir')) {
        // Hapus file lama
        $oldImagePath = public_path('upload/foto_grosir/' . $grosir->foto_grosir);
        if (file_exists($oldImagePath)) {
          unlink($oldImagePath);
        }

        // Simpan file baru
        $file = $request->file('foto_grosir');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('upload/foto_grosir'), $fileName);
        $grosir->foto_grosir = $fileName;
      }

      $grosir->nama_grosir = $request->input('nama_grosir');
      $grosir->alamat_grosir = $request->input('alamat_grosir');
      $grosir->nomor_telefon_grosir = $request->input('nomor_telefon_grosir');
      $grosir->save();

      $user->username = $request->input('username');
      if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
      }
      $user->save();

      return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
