<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use App\Models\ProdukGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
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
            'produk_index' => 'active',
            'produk' => Produk::all(),
        ];

        return view('pages.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'produk_create' => 'active',
        ];

        return view('pages.produk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_produk);

        $cek = Produk::create($data);
        if ($cek) {
            return redirect(route('produk.index'));
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
        $data = [
            'produk' => Produk::findOrFail($id),
        ];

        return view('pages.produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_produk);

        $produk = Produk::findOrFail($id);
        $cek = $produk->update($data);
        if ($cek) {
            return redirect(route('produk.index'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $cek = $produk->delete();
        if ($cek) {
            ProdukGaleri::where('produk_id', $id)->delete();
            return redirect(route('produk.index'));
        }
        return back();
    }

    public function galeri($id)
    {
        $data = [
            'produk_index' => 'active',
            'produk' => Produk::findOrFail($id),
            'produkGaleri' => ProdukGaleri::with('produk')->where('produk_id' , $id)->get(),
        ];

        return view('pages.produk.galeri', $data);
    }
}
