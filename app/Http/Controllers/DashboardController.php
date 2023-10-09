<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'dashboard'     => 'active',
            'pendapatan'    => Transaksi::where('status_transaksi', 1)->sum('total_transaksi'),
            'penjualan'     => Transaksi::count(),
            'trxTerkahir'   => Transaksi::orderBy('transaksi_id', 'DESC')->limit(5)->get(),
            'pie'           => [
                'PENDING'   => Transaksi::where('status_transaksi', 0)->count(),
                'SUKSES'    => Transaksi::where('status_transaksi', 1)->count(),
                'GAGAL'     => Transaksi::where('status_transaksi', 2)->count(),
            ],
        ];

        return view('pages.dashboard', $data);
    }
}
