@extends('layouts.default')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Foto Produk <em>"{{ $produk->nama_produk }}"</em></h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr style="font-weight: bold">
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Foto</th>
                                    <th>Default</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkGaleri as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td>
                                        <img src="{{ $item->foto_produk }}" alt="gambar_produk">
                                    </td>
                                    <td>{{ $item->is_default ? 'Ya' : 'Tidak' }}</td>
                                    <td>
                                        <form action="{{ route('foto-produk.destroy', $item->produk_galeri_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus barang ini ?')"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">Foto Produk Tidak Tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
