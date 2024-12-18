<?php

namespace App\Http\Controllers\Grosir;

use App\Models\Grosir;
use App\Models\Produk;
use App\Models\KelolaStok;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GrosirKelolaStok extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $grosir = Grosir::where('id_user', $user->id)->first();
        $kelolaStok = KelolaStok::where('id_grosir', $grosir->id)->with('produk')->get();

        return view('grosir.kelola.kelola', compact('kelolaStok'));
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
    public function show(string $slug)
    {
        $user = Auth::user();
        $grosir = Grosir::where('id_user', $user->id)->first();

        $nama_produk = Str::lower((Str::title(str_replace('-', ' ', $slug))));
        $produk = Produk::where('nama_produk', $nama_produk)->first();

        $kelola = KelolaStok::where('id_grosir', $grosir->id)->where('id_produk', $produk->id)->with('produk')->first();
        
        return view('grosir.kelola.update', compact('kelola'));
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
    public function update(Request $request)
    {
        $kelola = KelolaStok::find($request->id);
        
        if ($kelola) {
            $request->validate([
                'stok_produk' => 'required|integer|min:0|max:' . $kelola->stok_produk,
            ], [
                'required' => 'Stok produk harus diisi.',
                'integer' => 'Stok produk harus berupa angka.',
                'min' => 'Stok produk minimal 0.',
                'max' => 'Stok produk tidak boleh melebihi stok saat ini.',
            ]);
            
            $kelola->stok_produk = $request->stok_produk;
            $kelola->save();
            
            return redirect()->back()->with('success', 'Stok produk berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui stok produk. ID tidak ditemukan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
