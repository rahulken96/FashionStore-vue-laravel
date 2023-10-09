<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiRequest;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'trx_index' => 'active',
            'trx'       => Transaksi::all(),
        ];

        return view('pages.transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'trx_index' => 'active',
            'detailTransaksi' => Transaksi::with('detail.produk')->findOrFail($id),
        ];

        return view('pages.transaksi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'trx_index' => 'active',
            'transaksi' => Transaksi::findOrFail($id),
        ];

        return view('pages.transaksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiRequest $request, $id)
    {
        $data = $request->all();

        $trx = Transaksi::findOrFail($id);
        $cek = $trx->update($data);

        if ($cek) {
            return redirect(route('transaksi.index'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trx = Transaksi::findOrFail($id);
        $cek = $trx->delete();
        if ($cek) {
            return redirect(route('transaksi.index'));
        }
        return back();
    }

    public function setStatus($id)
    {
        Request()->validate([
            'status' => 'required|in:0,1,2',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = Request()->status;

        if ($transaksi->save()) {
            return redirect(route('transaksi.index'));
        }
        return back();
    }
}
