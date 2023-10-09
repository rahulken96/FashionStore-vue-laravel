@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit Transaksi - <i>{{ $transaksi->uuid }}</i></strong>
        </div>
        <div class="card-body">
            <div class="card-block">
                <form action="{{ route('transaksi.update', $transaksi->transaksi_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama Pemesan</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $transaksi->nama) }}"
                            class="form-control @error('nama') is-invalid @enderror" />
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-control-label">E-Mail Pemesan</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $transaksi->email) }}"
                            class="form-control @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="noHP" class="form-control-label">No. HP</label>
                        <input type="text" name="noHP" id="noHP" value="{{ old('noHP', $transaksi->noHP) }}"
                            class="form-control @error('noHP') is-invalid @enderror" />
                        @error('noHP')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat Pemesan</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5">{{ old('alamat', $transaksi->alamat) }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ route('transaksi.index') }}'">Kembali</button>
                        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
