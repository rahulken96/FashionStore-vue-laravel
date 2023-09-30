@extends('layouts.default')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Produk</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr style="font-weight: bold">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->tipe_produk }}</td>
                                    <td>Rp {{ number_format($item->harga_produk, '0', ',', '.') }}</td>
                                    <td>{{ $item->produk_qty }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm"><i class="fa fa-picture-o"></i> Galeri</a>
                                        <a href="{{ route('produk.edit', $item->produk_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                        <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus barang ini ?')"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">Produk Kosong</td>
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
