{{-- Tampilan Modal --}}
<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <td>{{ $detailTransaksi->nama }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $detailTransaksi->email }}</td>
    </tr>
    <tr>
        <th>No. HP</th>
        <td>{{ $detailTransaksi->noHP }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $detailTransaksi->alamat }}</td>
    </tr>
    <tr>
        <th>Total Transaksi</th>
        <td>Rp {{ number_format($detailTransaksi->total_transaksi, '0', ',', '.') }}</td>
    </tr>
    <tr>
        <th>Status Transaksi</th>

        <td>
            @if($detailTransaksi->status_transaksi == 0)
                <span class="badge badge-warning text-dark">
                {{ 'PENDING' }}
            @elseif ($detailTransaksi->status_transaksi == 1)
                <span class="badge badge-success">
                {{ 'SUKSES' }}
            @else
                <span class="badge badge-danger">
                {{ 'GAGAL' }}
            @endif
                </span>
        </td>
    </tr>
    <tr>
        <th>Pembelian Produk</th>
        <td>
            <table class="table table-bordered w-100">
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                </tr>
                @foreach ($detailTransaksi->detail as $item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>{{ $item->produk->tipe_produk }}</td>
                        <td>Rp {{ number_format($item->produk->harga_produk, '0', ',', '.') }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>
<div class="row">
    <div class="col-4">
            <a href="{{ route('transaksi.status', $detailTransaksi->transaksi_id) }}?status=1" class="btn btn-success btn-block btn-sm">
                <i class="fa fa-check"> Terima</i>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('transaksi.status', $detailTransaksi->transaksi_id) }}?status=2" class="btn btn-danger btn-block btn-sm">
                <i class="fa fa-times"> Tolak</i>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('transaksi.status', $detailTransaksi->transaksi_id) }}?status=0" class="btn btn-warning btn-block btn-sm">
                <i class="fa fa-refresh fa-spin"></i> Pending
            </a>
        </div>
</div>
{{-- Tampilan Modal --}}
