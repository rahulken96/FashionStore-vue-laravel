@extends('layouts.default')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Transaksi</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr style="font-weight: bold" align="center">
                                    <th>#</th>
                                    <th>Nama Pembeli</th>
                                    <th>Email</th>
                                    <th>Nomor</th>
                                    <th>Total Trx.</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trx as $item)
                                <tr align="center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->noHP }}</td>
                                    <td>Rp {{ number_format($item->total_transaksi,'0',',','.') }}</td>
                                    <td>
                                        @if($item->status_transaksi == 0)
                                            <span class="badge badge-warning text-dark">
                                            {{ 'PENDING' }}
                                        @elseif ($item->status_transaksi == 1)
                                            <span class="badge badge-success">
                                            {{ 'SUKSES' }}
                                        @else
                                            <span class="badge badge-danger">
                                            {{ 'GAGAL' }}
                                        @endif
                                            </span>
                                    </td>
                                    <td>
                                        {{-- @if($item->status_transaksi == 0)
                                            <a href="{{ route('transaksi.status', $item->transaksi_id) }}?status=1" class="btn btn-info btn-sm"><i class="fa fa-check"></i> Konfirmasi</a>
                                            <a href="{{ route('transaksi.status', $item->transaksi_id) }}?status=2" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batalkan</a>
                                        @endif --}}
                                        <a href="#modal-lihat" data-remote="{{ route('transaksi.show', $item->transaksi_id) }}" data-toggle="modal" data-target="#modal-lihat" data-title="<b>Detail Transaksi - <i>{{ $item->uuid }}</i></b>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                                        <a href="{{ route('transaksi.edit', $item->transaksi_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Ubah</a>
                                        <form action="{{ route('transaksi.destroy', $item->transaksi_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus barang ini ?')"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">Data Transaksi Tidak Tersedia.</td>
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
