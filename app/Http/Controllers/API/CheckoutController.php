<?php

namespace App\Http\Controllers\API;

use App\Http\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $data = $request->except('detail_transaksi');
        $data['uuid'] = 'TRX' . mt_rand(1000,9999) . date('dmyhis');

        $trx = Transaksi::create($data);

        foreach ($request->detail_transaksi as $key => $detailProduk) {

            $detailTRX[] = new TransaksiDetail([
               'transaksi_id' => $trx->transaksi_id,
               'produk_id' => $detailProduk,
            ]);

            Produk::find($detailProduk)->decrement('produk_qty');
        }

        $trx->detail()->saveMany($detailTRX);

        return ResponseFormatter::sukses($trx);
    }
}
