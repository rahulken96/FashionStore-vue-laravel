@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Foto Produk</strong>
        </div>
        <div class="card-body">
            <div class="card-block">
                <form action="{{ route('foto-produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="produk_id" class="form-control-label">Nama Produk</label>
                        <select name="produk_id" id="produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
                            <option value="" disabled selected>-Pilih Produk-</option>
                            @foreach ($produk as $list)
                                <option value="{{ $list->produk_id }}" {{ old('produk_id') == $list->produk_id ? 'selected' : '' }}>{{ $list->nama_produk }}</option>
                            @endforeach
                        </select>
                        @error('produk_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto_produk" class="form-control-label">Foto Produk</label>
                        <input type="file" name="foto_produk" id="foto_produk" value="{{ old('foto_produk') }}" class="form-control @error('foto_produk') is-invalid @enderror" required/>
                        @error('foto_produk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="is_default" class="form-control-label">Jadikan Default ?</label>
                        <br>
                        <label for="">
                            <input type="radio" name="is_default" value="1"> Ya
                        </label>
                        &nbsp;
                        <label for="">
                            <input type="radio" name="is_default" value="0"> Tidak
                        </label>
                        @error('is_default')
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
