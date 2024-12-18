<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Grosir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GrosirRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('authentication.register-grosir');
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
      $validatedData = $request->validate([
        'username' => 'required|unique:users|max:255',
        'password' => 'required|confirmed|min:8',
      ], [
        'username.required' => 'Nama pengguna wajib diisi.',
        'username.unique' => 'Nama pengguna sudah ada.',
        'username.max' => 'Nama pengguna harus tidak boleh lebih dari 255 karakter.',
        'password.required' => 'Kata sandi wajib diisi.',
        'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        'password.min' => 'Kata sandi harus terdiri dari minimal 8 karakter.',
      ]);

      $user = User::create ([
          'username' => $validatedData['username'],
          'password' => bcrypt($validatedData['password']),
        ]);

      Auth::login($user);

      $randomGrosirName = 'Grosir_' . Str::random(10);

      $grosir = Grosir::create([
        'id_user' => $user->id,
        'nama_grosir' => $randomGrosirName,
      ]);

      // Menambahkan pesan peringatan ke session
      session()->flash('warning', 'Silakan update nomor telepon dan alamat Anda.');

      return redirect()->route('grosir.profile');
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
