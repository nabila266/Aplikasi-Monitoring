<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgenController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('agen.dashboard');
  }

  public function profil()
  {
    $agen = Agen::where('id_user', Auth::user()->id)->with('user')->first();

    return view('agen.profil', compact('agen'));
  }

  public function profil_update(Request $request)
  {
    $request->validate([
      'nama_agen' => 'required|string|max:255',
      'alamat_agen' => 'required|string|max:1000',
      'username' => 'required|string|max:255',
      'foto_agen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menerima file gambar saja
    ]);

    // Cari model Agen berdasarkan ID user yang autentikasi
    $agen = Agen::findOrFail(Auth::user()->id);

    // Update informasi agen
    $agen->nama_agen = $request->nama_agen;
    $agen->alamat_agen = $request->alamat_agen;
    $agen->user->username = $request->username;
    $agen->user->save();

    // Handle file upload untuk avatar
    if ($request->hasFile('foto_agen')) {
      // Hapus foto lama jika ada
      $currentPath = str_replace(asset(''), '', $agen->foto_agen); // Menghapus base URL untuk mendapatkan path relatif
      if ($agen->foto_agen && Storage::exists('public/' . $currentPath)) {
        Storage::delete('public/' . $currentPath);
      }

      // Simpan file baru
      $file = $request->file('foto_agen');
      $filename = time() . '_' . $file->getClientOriginalName(); // Menggunakan timestamp untuk nama file yang unik
      Storage::putFileAs('public/upload/foto_agen', $file, $filename); // Memindahkan file ke folder public/upload/foto_agen

      // Update database dengan URL baru
      $agen->foto_agen = 'upload/foto_agen/' . $filename;
      $agen->save();
    }

    $agen->save();

    return redirect()->route('agen.profil')->with('success', 'Profil berhasil diperbarui.');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Agen $agen)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Agen $agen)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Agen $agen)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Agen $agen)
  {
    //
  }
}
