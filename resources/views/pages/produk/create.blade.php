@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Produk</strong>
        </div>
        <div class="card-body">
            <div class="card-block">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_produk" class="form-control-label">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                            class="form-control @error('nama_produk') is-invalid @enderror" />
                        @error('nama_produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_produk" class="form-control-label">Tipe Produk</label>
                        <input type="text" name="tipe_produk" id="tipe_produk" value="{{ old('tipe_produk') }}"
                            class="form-control @error('tipe_produk') is-invalid @enderror" />
                        @error('tipe_produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_produk" class="form-control-label">Deskripsi Produk</label>
                        <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control @error('deskripsi_produk') is-invalid @enderror" rows="30">{{ old('deskripsi_produk') }}</textarea>
                        @error('deskripsi_produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga_produk" class="form-control-label">Harga Produk</label>
                        <input type="number" name="harga_produk" id="harga_produk" value="{{ old('harga_produk') }}"
                            class="form-control @error('harga_produk') is-invalid @enderror" />
                        @error('harga_produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="produk_qty" class="form-control-label">Kuantitas Produk</label>
                        <input type="number" name="produk_qty" id="produk_qty" value="{{ old('produk_qty') }}"
                            class="form-control @error('produk_qty') is-invalid @enderror" />
                        @error('produk_qty')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ route('produk.index') }}'">Kembali</button>
                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('pasca-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
            ClassicEditor
                .create( document.querySelector( '#deskripsi_produk' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
    </script>
@endpush
