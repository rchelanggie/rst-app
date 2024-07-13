@extends('layout.two-frame')
@section('content')
<div id="main" class="container">
    <div class="content ml-5">
        <h2 style="color: #001F3F; font-size: 3rem;">Pengisian Data Perangkat Lunak</h2>
        <div class="card" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; width: 100%;">
            <form id="form-data" action="{{ route('store-data') }}" method="post">
                @csrf

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="nama" style="font-size: 1rem; font-weight: 500; display: block;">Nama Perangkat Lunak</label>
                    <input class="form-control form-control-sm @error('nama') is-invalid @enderror" name="nama" type="text" placeholder="Nama Perangkat Lunak" value="{{ old('nama') }}">
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="informasi" style="font-size: 1rem; font-weight: 500; display: block;">Informasi</label>
                    <input class="form-control form-control-sm @error('informasi') is-invalid @enderror" name="informasi" type="text" placeholder="Informasi" value="{{ old('informasi') }}">
                    @error('informasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="deskripsi" style="font-size: 1rem; font-weight: 500; display: block;">Deskripsi Aplikasi</label>
                    <input class="form-control form-control-sm @error('deskripsi') is-invalid @enderror" name="deskripsi" type="text" placeholder="Deskripsi Aplikasi" value="{{ old('deskripsi') }}">
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="developer" style="font-size: 1rem; font-weight: 500; display: block;">Developer</label>
                    <input class="form-control form-control-sm @error('developer') is-invalid @enderror" name="developer" type="text" placeholder="Developer" value="{{ old('developer') }}">
                    @error('developer')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="submit-btn" style="text-align: right; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary" style="background-color: #00c96b; border-color: #00c96b; border-radius: 50px; padding: 15px 50px;">Selanjutnya →</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
