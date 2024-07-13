@extends('layout.one-frame')

@section('content-center')
    <div>
        <div style="margin-left: 100px; margin-right: 100px">
            <div class="card text-center"
                style="background-color:#001F3F; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 5px; width: 70%;">
                <h2 style="color: white; font-size: 2.5rem; padding-left: 5px">Hasil Penilaian Perangkat Lunak</h2>
            </div>
            <div
                style="background-color: #CFE0ED;
                        border-radius: 5px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin-top: 20px;
                        margin-bottom: 20px;">
                @include('data.chart')
            </div>
            <h2 style="color: #001F3F; margin-bottom: 15px; text-align: center">Kesimpulan</h2>
            <hr style="border-top: 1px solid #001F3F; margin-bottom: 15px; width: 70%;">
            @foreach ($chart_data['labels'] as $labelIndex => $label)
                @php
                    $collapseId = 'collapseLabel' . $labelIndex;
                    $toggleId = 'toggleLabel' . $labelIndex;

                    // Menghitung total ulasan untuk atribut ini
                    $totalReviews = $chart_data['datasets'][0]['data'][$labelIndex] + $chart_data['datasets'][1]['data'][$labelIndex] + $chart_data['datasets'][2]['data'][$labelIndex];

                    // Menghitung persentase positif, negatif, dan netral untuk atribut ini
                    $positivePercentage = $totalReviews ?
                        ($chart_data['datasets'][1]['data'][$labelIndex] / $totalReviews) * 100 : 0;
                    $negativePercentage = $totalReviews ?
                        ($chart_data['datasets'][0]['data'][$labelIndex] / $totalReviews) * 100 : 0;
                    $neutralPercentage = $totalReviews ?
                        ($chart_data['datasets'][2]['data'][$labelIndex] / $totalReviews) * 100 : 0;

                    // Klasifikasi berdasarkan persentase positif untuk atribut ini
                    if ($positivePercentage <= 20) {
                        $positiveClassification = 'Sangat Tidak Baik';
                    } elseif ($positivePercentage <= 40) {
                        $positiveClassification = 'Tidak Baik';
                    } elseif ($positivePercentage <= 60) {
                        $positiveClassification = 'Netral';
                    } elseif ($positivePercentage <= 80) {
                        $positiveClassification = 'Baik';
                    } else {
                        $positiveClassification = 'Sangat Baik';
                    }
                @endphp
                <div
                    style="background-color: #FFFFFF; border: 1px solid #E0E0E0; border-radius: 8px; padding: 15px; margin-bottom: 10px; width: 70%; margin-right: auto; margin-left: auto">
                    <div style="display: flex; justify-content: space-between; align-items: center;" id="{{ $toggleId }}"
                        class="btn toggle-btn bg-transparent" data-toggle="collapse" href="#{{ $collapseId }}"
                        role="button" aria-expanded="false" aria-controls="{{ $collapseId }}">
                        <h3 style="font-size: 1.25rem; color: #333333; margin: 0;">{{ $label }}</h3>
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
                    <div class="collapse" id="{{ $collapseId }}" style="margin: 15px;">
                        <div>
                            Didapatkan {{ number_format($positivePercentage, 2) }}% ulasan positif,
                            {{ number_format($negativePercentage, 2) }}% ulasan negatif, dan {{ number_format($neutralPercentage, 2) }}% ulasan netral
                            sehingga dapat disimpulkan bahwa pada atribut {{ $label }}, {{ $positiveClassification }}.
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="content text-center" style="margin-bottom: 30px">
                @if (isset($result))
                    {{-- <p>Accuracy: {{ $result['accuracy'] }}</p> --}}
                    {{-- <pre>{{ print_r($result['classification_report'], true) }}</pre> --}}
                @endif
                <a id="download-pdf-btn" type="button" class="btn" style="cursor: pointer; font-weight: 500">
                    <span
                        style="padding-top: 8px; padding-bottom:9px; padding-right:50px; padding-left:50px; color: #0D63A5; border: 1px solid #0D63A5;">
                        Unduh PDF
                    </span>
                    <img src="{{ asset('images/IconUnduh.png') }}"
                        style="padding: 10px; background-color: #0D63A5; margin-bottom: 5px" alt="" width="40"
                        height="40">
                </a>
                <a href="{{ route('home') }}" class="btn"
                    style="border: 1px solid #dc3545; color: #dc3545;font-weight: 500; margin-bottom: 5px">
                    Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
    <input type="hidden" id="chart-data" value="{{ json_encode($chart_data) }}">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var downloadPdfBtn = document.getElementById('download-pdf-btn');
            var chartUrlInput = document.getElementById('chart-url');
            var chartDataInput = document.getElementById('chart-data');

            downloadPdfBtn.addEventListener('click', function() {
                var chartUrl = chartUrlInput.value;
                var chartData = JSON.parse(chartDataInput.value);

                if (chartUrl) {
                    console.log('Chart URL:', chartUrl);
                    var downloadUrl = "{{ route('download.pdf', $id) }}?chartUrl=" + encodeURIComponent(
                            chartUrl) +
                        "&chartData=" + encodeURIComponent(JSON.stringify(chartData));
                    window.location.href = downloadUrl;
                } else {
                    console.error('Chart URL is not available.');
                }
            });

            // Add click event to toggle cards
            $('.toggle-btn').click(function() {
                var collapseId = $(this).attr('href').substring(1);
                $('#' + collapseId).collapse('toggle');
            });
        });
    </script>
@endsection
