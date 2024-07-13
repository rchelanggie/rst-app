<!DOCTYPE html>
<html>

<head>
    <title>Document PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: left;
        }

        .container {
            width: 95%;
            margin: 0 auto;
        }

        .details {
            margin-bottom: 30px;
        }

        .details div {
            margin-bottom: 5px;
        }

        .details div span {
            display: inline-block;
            width: 150px;
        }

        .image-placeholder {
            width: 95%;
            height: 410px;
            background-color: #CFE0ED;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hasil Penilaian Perangkat Lunak</h1>
        <div class="details">
            <div><span>Nama</span> : {{ $data['nama'] }}</div>
            <div><span>Informasi</span> : {{ $data['informasi'] }}</div>
            <div><span>Deskripsi</span> : {{ $data['deskripsi'] }}</div>
            <div><span>Developer</span> : {{ $data['developer'] }}</div>
            <div><span>Metode</span> : {{ $data['metode']['metode'] }}</div>
            <div><span>Atribut</span> : {{ $data['option']['option'] }}</div>
        </div>
        <div class="image-placeholder">
            @if (isset($chartUrl))
                <img src="{{ public_path($chartUrl) }}" alt="" style="width: 95%">
            @else
                <div>Chart will be displayed here.</div>
            @endif
        </div>
        <div>
            <h3 style="color: #001F3F; text-align: center; margin-top: 20px">Kesimpulan</h3>
            @foreach ($chartData['labels'] as $labelIndex => $label)
                @php
                    $totalReviews = $chartData['datasets'][0]['data'][$labelIndex] + $chartData['datasets'][1]['data'][$labelIndex] + $chartData['datasets'][2]['data'][$labelIndex];

                    // Menghitung persentase positif dan negatif untuk atribut ini
                    $positivePercentage = $totalReviews ?
                        ($chartData['datasets'][1]['data'][$labelIndex] / $totalReviews) * 100 : 0;
                    $negativePercentage = $totalReviews ?
                        ($chartData['datasets'][0]['data'][$labelIndex] / $totalReviews) * 100 : 0;
                    $neutralPercentage = $totalReviews ?
                        ($chartData['datasets'][2]['data'][$labelIndex] / $totalReviews) * 100 : 0;

                    // Klasifikasi berdasarkan persentase positif untuk atribut ini
                    if ($positivePercentage <= 20) {
                        $positiveClassification = 'Sangat Tidak Baik dan dibutuhkan peningkatan';
                    } elseif ($positivePercentage <= 40) {
                        $positiveClassification = 'Tidak Baik dan dibutuhkan peningkatan';
                    } elseif ($positivePercentage <= 60) {
                        $positiveClassification = 'Netral';
                    } elseif ($positivePercentage <= 80) {
                        $positiveClassification = 'Baik';
                    } else {
                        $positiveClassification = 'Sangat Baik';
                    }
                @endphp
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 1rem; color: #333333; margin: 0;">{{ $label }}</h3>
                    </div>
                    <div style="margin-top: 10px; margin-bottom: 15px">
                        <div>
                            Didapatkan {{ number_format($positivePercentage, 2) }}% ulasan positif,
                            {{ number_format($negativePercentage, 2) }}% ulasan negatif, dan {{ number_format($neutralPercentage, 2) }}% ulasan netral,
                            sehingga dapat disimpulkan bahwa pada atribut {{ $label }}, {{ $positiveClassification }}.
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
