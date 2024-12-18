<?php

namespace App\Http\Controllers\Agen;

use App\Models\Grosir;
use App\Models\KelolaStok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgenKelolaStokController extends Controller
{
    public function index(string $id)
    {
        $grosir = Grosir::find($id);
        $kelolaStok = KelolaStok::where('id_grosir', $grosir->id)->with('produk')->get();

        return view('agen.transaksi.kelola', compact('kelolaStok', 'grosir'));
    }
}
