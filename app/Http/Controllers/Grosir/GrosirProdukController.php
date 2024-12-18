<?php

namespace App\Http\Controllers\Grosir;

use App\Http\Controllers\Controller;
use App\Models\Grosir;
use App\Models\Produk;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GrosirProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $products = Produk::where('status', 'tersedia')->get();

      return view('grosir.product', compact('products'));
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
    public function show(string $nama_produk)
    {
      $slug = Str::of($nama_produk)->replace('-', ' ');

      $user = Auth::user();
      $grosir = Grosir::where('id_user', $user->id)->first();
      $product = Produk::where('nama_produk', $slug)->first();
      $wishlist = Wishlist::where('id_grosir', $grosir->id)->where('id_produk', $product->id)->first();

      return view('grosir.product.detail', compact('product', 'wishlist'));
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
