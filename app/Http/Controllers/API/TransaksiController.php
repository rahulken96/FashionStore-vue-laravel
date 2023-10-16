<?php

namespace App\Http\Controllers\API;

use App\Http\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function get($id)
    {
        $produk = Transaksi::with('detail.produk')->find($id);
        return ResponseFormatter::responseTRX($produk);
    }
}
