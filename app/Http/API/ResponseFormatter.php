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
        if ($data) {
            return self::sukses($data, "Data Produk Berhasil Diambil!");
        } else {
            return self::gagal($data, "Data Produk Gagal Diambil!");
        }
    }
}
