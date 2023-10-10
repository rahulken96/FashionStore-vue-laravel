<?php

namespace App\Http\Controllers\API;

use App\Http\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function all(Request $request)
    {
        $limit = $request->limit ?? 5;
        $produk_id = $request->id;
        $nama_produk = $request->nama;
        $slug = $request->slug;
        $tipe_produk = $request->tipe;
        $harga_min = $request->min;
        $harga_max = $request->max;

        if ($produk_id) {
            $produk = Produk::with('galeri')->find($produk_id);
            return ResponseFormatter::responseProduk($produk);
        } elseif ($slug) {
            $produk = Produk::with('galeri')->where('slug', $slug)->first();
            return ResponseFormatter::responseProduk($produk);
        }else{
            $produk = Produk::with('galeri')->limit($limit)->get();
            return ResponseFormatter::responseProduk($produk);
        }
    }
}
