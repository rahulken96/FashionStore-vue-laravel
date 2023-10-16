<?php

namespace App\Http\API;

class ResponseFormatter
{
    protected static $response = [
        'meta'  => [
            'code'      => 401,
            'status'    => 'KOSONG',
            'msg'       => null,
        ],
        'data'  => null,
    ];

    public static function sukses($data = null, $msg = null)
    {
        self::$response['meta']['code']     = 200;
        self::$response['meta']['status']   = 'SUKSES';
        self::$response['meta']['msg']      = $msg;
        self::$response['data']             = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function gagal($data = null, $msg = null)
    {
        self::$response['meta']['code']     = 400;
        self::$response['meta']['status']   = 'GAGAL';
        self::$response['meta']['msg']      = $msg;
        self::$response['data']             = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function responseProduk($data)
    {
        if (!empty($data)) {
            return self::sukses($data, "Data Produk Berhasil Diambil!");
        } else {
            return self::gagal($data, "Data Produk Gagal Diambil!");
        }
    }

    public static function responseCheckout($data)
    {
        if (!empty($data)) {
            return self::sukses($data, "Checkout Berhasil dilakukan!");
        } else {
            return self::gagal($data, "Checkout Gagal dilakukan!");
        }
    }

    public static function responseTRX($data)
    {
        if (!empty($data)) {
            return self::sukses($data, "Data Transaksi Berhasil diambil!");
        } else {
            return self::gagal($data, "Data Transaksi Gagal diambil!");
        }
    }
}
