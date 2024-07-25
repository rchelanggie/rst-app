@extends('layout.two-frame')
@section('content')
<div id="main" class="container">
    <div class="content ml-5">
        <h2 style="color: #001F3F; font-size: 3rem;">Form Request Pengelolaan Aplikasi</h2>
        <div class="card" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; width: 100%;">
            <form id="form-data" action="{{ route('store-data') }}" method="post">
                @csrf

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="namast" style="font-size: 1rem; font-weight: 500; display: block;">Nama Software Tester</label>
                    <input class="form-control form-control-sm @error('namast') is-invalid @enderror" name="namast" type="text" placeholder="Nama Software Tester" value="{{ old('namast') }}">
                    @error('namast')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="metode" style="font-size: 1rem; font-weight: 500; display: block;">Metode Usulan</label>
                    <input class="form-control form-control-sm @error('metode') is-invalid @enderror" name="metode" type="text" placeholder="Metode Usulan" value="{{ old('metode') }}">
                    @error('metode')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="deskripsimt" style="font-size: 1rem; font-weight: 500; display: block;">Deskripsi Metode</label>
                    <input class="form-control form-control-sm @error('deskripsimt') is-invalid @enderror" name="deskripsimt" type="text" placeholder="Deskripsi Metode" value="{{ old('deskripsimt') }}">
                    @error('deskripsimt')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="width: 50%; margin-bottom: 1rem;">
                    <label for="kontak" style="font-size: 1rem; font-weight: 500; display: block;">Kontak</label>
                    <input class="form-control form-control-sm @error('kontak') is-invalid @enderror" name="kontak" type="text" placeholder="Kontak" value="{{ old('kontak') }}">
                    @error('kontak')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="submit-btn" style="text-align: right; margin-top: 2rem;">
                    <button type="button" id="refresh-btn" class="btn btn-primary" style="background-color: #00c96b; border-color: #00c96b; border-radius: 50px; padding: 15px 50px;">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('refresh-btn').addEventListener('click', function() {
    // Refresh halaman
    window.location.reload();
});
</script>
@endsection
