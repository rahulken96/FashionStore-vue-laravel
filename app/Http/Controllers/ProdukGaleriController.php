<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukGaleriRequest;
use App\Models\Produk;
use App\Models\ProdukGaleri;
use Illuminate\Http\Request;

class ProdukGaleriController extends Controller
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
            'produk_galeri_index' => 'active',
            'produk' => ProdukGaleri::with('produk')->get(),
        ];

        return view('pages.produk-galeri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'produk_galeri_create' => 'active',
            'produk' => Produk::all(),
        ];

        return view('pages.produk-galeri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukGaleriRequest $request)
    {
        $data = $request->all();
        $data['foto_produk'] = $request->file('foto_produk')->store('gambar-produk', 'public');

        $cek = ProdukGaleri::create($data);
        if ($cek) {
            return redirect(route('foto-produk.index'));
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukGaleriRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fotoProduk = ProdukGaleri::findOrFail($id);
        $cek = $fotoProduk->delete();
        if ($cek) {
            return redirect(route('foto-produk.index'));
        }
        return back();
    }
}
