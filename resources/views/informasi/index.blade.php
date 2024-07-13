@extends('layout.three-frame')

@section('content')
    <div id="main">
        <div class="content m-5">
            <h2 style="color: #001F3F; font-size:4rem">Informasi Aplikasi</h2>
            <div class="info-box" style="font-size: 1.1rem; margin:20px">
                <p>Aplikasi ini merupakan aplikasi yang dikembangkan untuk membantu menilai produk perangkat lunak dengan
                    lebih efisien dan efektif. Diharapkan melalui penggunaan aplikasi ini, proses penilaian kualitas
                    perangkat lunak akan menjadi lebih terstruktur dan komprehensif, memungkinkan para profesional dalam
                    industri untuk mengidentifikasi kekurangan dan potensi perbaikan dengan lebih baik sehingga perangkat
                    lunak dapat sesuai dengan standar ISO/IEC 25010.</p>
            </div>

            <div class="methods" style="padding: 20px; border-radius: 8px; margin-top: 80px;">
                <h3><b>Metode</b> yang digunakan dalam Aplikasi</h3>
                <p>Menggunakan berbagai metode dan algoritma dalam evaluasi kualitas perangkat lunak untuk memberikan
                    pemahaman yang mendalam kepada pengguna.</p>

                @foreach ($metode as $index => $item)
                    @php
                        $collapseId = 'collapseMethod' . $index;
                        $toggleId = 'toggleMethod' . $index;
                    @endphp
                    <div class="method"
                        style="background-color: #FFFFFF; border: 1px solid #E0E0E0; border-radius: 8px; padding: 25px; margin-bottom: 10px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 style="font-size: 1.25rem; color: #333333; margin: 0;">{{ $item->metode }}</h3>
                            <a id="{{ $toggleId }}" class="btn toggle-btn bg-transparent" data-toggle="collapse"
                                href="#{{ $collapseId }}" role="button" aria-expanded="false"
                                aria-controls="{{ $collapseId }}"
                                style="display: flex;
                            justify-content: center;
                            align-items: center;
                            width: 30px;
                            height: 30px;
                            border: 2px solid #3056D3;
                            border-radius: 50%;
                            color: #3056D3;
                            background-color: transparent;
                            padding-top:1px;
                            font-size: 1.25rem;">
                                <span class="icon" style="color: #3056D3">+</span>
                            </a>
                        </div>
                        <div class="collapse" id="{{ $collapseId }}" style="margin-top: 10px;">
                            <div>
                                {{ $item->deskripsi }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.toggle-btn');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const icon = this.querySelector('.icon');
                    if (this.getAttribute('aria-expanded') === 'true') {
                        icon.textContent = '+';
                    } else {
                        icon.textContent = '-';
                    }
                });
            });

            $('.collapse').on('show.bs.collapse', function() {
                const toggle = $(`a[href="#${this.id}"]`);
                toggle.find('.icon').text('-');
            });

            $('.collapse').on('hide.bs.collapse', function() {
                const toggle = $(`a[href="#${this.id}"]`);
                toggle.find('.icon').text('+');
            });
        });
    </script>
@endsection
