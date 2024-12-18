<?php

namespace App\Http\Controllers\Grosir;

use App\Http\Controllers\Controller;
use App\Models\Grosir;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrosirWishlistController extends Controller
{
    public function index()
    {
        $grosir = Grosir::where('id_user', Auth::id())->first();
        $wishlists = Wishlist::where('id_grosir', $grosir->id)->get();

        $wishlistsWithProducts = $wishlists->map(function ($wishlist) {
            return [
                'wishlist' => $wishlist,
                'product' => $wishlist->product
            ];
        });

        return view('grosir.wishlist', compact('wishlistsWithProducts'));
    }

    public function add(Request $request)
    {
        Wishlist::updateOrCreate([
            'id_grosir' => $request->id_grosir,
            'id_produk' => $request->id_produk,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke wishlist!');
    }

    public function remove(Request $request)
{
    $grosir = Grosir::where('id_user', Auth::id())->first();
    if (!$grosir) {
        return redirect()->back()->with('error', 'Grosir tidak ditemukan.');
    }

    $wishlist = Wishlist::where('id_grosir', $grosir->id)
        ->where('id_produk', $request->id_produk)
        ->first();
        
    if ($wishlist) {
        $wishlist->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari wishlist!');
    }

    return redirect()->back()->with('error', 'Produk tidak ditemukan di wishlist.');
}

}
