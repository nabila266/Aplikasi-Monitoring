<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
  public function update(Request $request)
  {
      // Validasi input
      $request->validate([
        'current-password' => 'required',
        'password' => 'required|string|min:8|confirmed', // 'confirmed' memastikan bahwa 'password' dan 'password_confirmation' cocok
      ], [
        'current-password.required' => 'Kata sandi saat ini wajib diisi.',
        'password.required' => 'Kata sandi baru wajib diisi.',
        'password.min' => 'Kata sandi baru harus minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
      ]);

      $user = Auth::user();

      // Periksa apakah kata sandi saat ini cocok
      if (!Hash::check($request->input('current-password'), $user->password)) {
        return back()->withErrors(['current-password' => 'Kata sandi saat ini tidak sesuai.']);
      }

      // Update kata sandi
      $user->password = Hash::make($request->input('password'));
      $user->save();

      return redirect()->route('agen.profil')->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
