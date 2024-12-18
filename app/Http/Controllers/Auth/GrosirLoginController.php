<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Grosir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GrosirLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('authentication.login-grosir');
    }

  public function login(Request $request)
  {
    // Validasi data yang diterima dari form login
    $validatedData = $request->validate([
      'username' => 'required|max:255',
      'password' => 'required|min:8',
    ], [
      'username.required' => 'Nama pengguna wajib diisi.',
      'username.max' => 'Nama pengguna harus tidak boleh lebih dari 255 karakter.',
      'password.required' => 'Kata sandi wajib diisi.',
      'password.min' => 'Kata sandi harus terdiri dari minimal 8 karakter.',
    ]);

    // Mengambil pengguna berdasarkan username
    $user = User::where('username', $request->username)->first();

    // Memeriksa apakah pengguna ditemukan dan password cocok
    if (!$user || !Hash::check($request->password, $user->password)) {
      // Jika tidak ditemukan atau password tidak cocok, redirect kembali dengan pesan error
      return redirect()->route('grosir.login')->with('error', 'Username atau password salah');
    }

    // Jika pengguna ditemukan dan password cocok, login pengguna
    Auth::login($user);

    $grosir = Grosir::where('id_user', $user->id)->first();

    if ($grosir) {
      return redirect()->route('grosir.index');
    } else {
      return redirect()->route('grosir.form');
    }

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
