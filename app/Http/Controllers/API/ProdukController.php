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

        $query = Produk::with('galeri');
        if ($produk_id) {
            $produk = $query->find($produk_id);
            return ResponseFormatter::responseProduk($produk);
        }
        if ($slug) {
            $produk = $query->where('slug', $slug)->first();
            return ResponseFormatter::responseProduk($produk);
        }
        if ($nama_produk) {
            $produk = $query->where('nama_produk', 'like', "%$nama_produk%")->get();
            return ResponseFormatter::responseProduk($produk);
        }
        if ($tipe_produk) {
            $produk = $query->where('tipe_produk', 'like', "%$tipe_produk%")->get();
            return ResponseFormatter::responseProduk($produk);
        }
        if ($harga_min) {
            $produk = $query->where('harga_produk', '>=', $harga_min)->get();
            return ResponseFormatter::responseProduk($produk);
        }
        if ($harga_max) {
            $produk = $query->where('harga_produk', '<=', $harga_max)->get();
            return ResponseFormatter::responseProduk($produk);
        }
        else{
            $produk = $query->orderBy('produk_id', 'DESC')->limit($limit)->get();
            return ResponseFormatter::responseProduk($produk);
        }
    }
}
