<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Atribut;
use App\Models\AtributeOption;
use App\Models\Metode;
use App\Models\Option;
use App\Models\Panduan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Panduan::create([
            'panduan' => 'Melihat Informasi Aplikasi',
            'icon' => 'Panduan1'
        ]);
        Panduan::create([
            'panduan' => 'Melihat Panduan Penggunaan Aplikasi',
            'icon' => 'Panduan2' 
        ]);
        Panduan::create([
            'panduan' => 'Mengunduh Template File User Review',
            'icon' => 'Panduan3'  
        ]);
        Panduan::create([
            'panduan' => 'Memilih Atribut dan Metode yang Ingin Diuji',
            'icon' => 'Panduan4' 
        ]);
        Panduan::create([
            'panduan' => 'Mengunggah File User Review',
            'icon' => 'Panduan5'  
        ]);
        Panduan::create([
            'panduan' => 'Melakukan Penilaian Kualitas Perangkat Lunak',
            'icon' => 'Panduan6'
        ]);
        Panduan::create([
            'panduan' => 'Melihat dan Mengunduh Hasil Penilaian Kualitas Perangkat Lunak',
            'icon' => 'Panduan7'
        ]);

        Metode::create([
            'metode' => 'Random Forest',
            'deskripsi' => 'Random Forest adalah metode ensemble learning yang digunakan untuk klasifikasi, regresi, dan tugas lainnya yang menggabungkan beberapa pohon keputusan untuk meningkatkan akurasi dan kontrol overfitting. Metode ini bekerja dengan membuat banyak pohon keputusan selama pelatihan dan menghasilkan kelas yang menjadi mode dari kelas (klasifikasi) atau rata-rata prediksi (regresi) dari masing-masing pohon.'
        ]);
        Metode::create([
            'metode' => 'Support Vector Machine',
            'deskripsi' => 'Support Vector Machine (SVM) adalah metode pembelajaran mesin yang digunakan untuk klasifikasi dan regresi. SVM bekerja dengan mencari hyperplane di ruang dimensi tinggi yang secara jelas memisahkan titik data dari kelas yang berbeda. Algoritme ini sangat efektif dalam ruang dimensi tinggi dan dikenal karena keefektifannya dalam klasifikasi binary.'
        ]);
        Metode::create([
            'metode' => 'Stochastic Gradient Descent',
            'deskripsi' => 'Stochastic Gradient Descent (SGD) adalah metode optimisasi yang digunakan untuk melatih model pembelajaran mesin. Metode ini memperbarui parameter model berdasarkan estimasi acak dari
            gradien fungsi biaya, menggunakan satu atau beberapa sampel acak dari data. Hal ini membuat
            proses pelatihan lebih cepat dan efisien. SGD sering digunakan dalam pelatihan jaringan neural
            dan regresi logistik.'
        ]);

        Option::create([
            'option' => 'Compatibility, Portability, dan Maintainability',
        ]);

        Option::create([
            'option' => 'Performance Efficiency, Security, dan Reliability',
        ]);

        Option::create([
            'option' => 'Functional Suitability dan Usability',
        ]);

        Option::create([
            'option' => 'All atribute',
        ]);

        Atribut::create([
            'atribut' => 'Functional Suitability',
            'deskripsi' => 'Karakteristik ini mengukur sejauh mana produk atau sistem menyediakan fungsi yang memenuhi kebutuhan ketika digunakan dalam kondisi tertentu.'

        ]);
        Atribut::create([
            'atribut' => 'Performance Efficiency',
            'deskripsi' => 'Karakteristik ini mengukur kinerja relatif terhadap sumber daya yang digunakan dalam kondisi tertentu pada suatu system.'
        ]);
        Atribut::create([
            'atribut' => 'Compatibility',
            'deskripsi' => 'Karakteristik ini mengukur sejauh mana suatu sistem dapat bertukar informasi dengan sistem lain dan melakukan fungsi yang disyaratkan saat berbagi lingkungan perangkat keras atau perangkat lunak yang sama.'

        ]);
        Atribut::create([
            'atribut' => 'Usability',
            'deskripsi' => 'Karakteristik ini mengukur sejauh mana sistem dapat digunakan oleh pengguna untuk mencapai tujuan yang ditentukan dengan efektivitas, efisiensi, dan kepuasan dalam konteks penggunaan tertentu.'

        ]);
        Atribut::create([
            'atribut' => 'Reliability',
            'deskripsi' => 'Karakteristik ini mengukur sejauh mana sistem dapat melakukan fungsi dalam kondisi yang ditentukan untuk periode waktu terentu.'

        ]);
        Atribut::create([
            'atribut' => 'Security',
            'deskripsi' => 'Karakteristik ini mengukur suatu sistem dalam melakukan proteksi terhadap informasi dan data, sehingga sistem memiliki tingkat akses data sesuai dengan jenis dan tingkat otorisasi.'
            
        ]);
        Atribut::create([
            'atribut' => 'Maintainability',
            'deskripsi' => 'Karakteristik ini mewakili tingkat efektivitas dan efisiensi dalam proses modifikasi untuk perbaikan sistem sesuai dengan penyesuaian dan perubahan pada lingkungan operasional, termasuk kemudahan identifikasi kesalahan serta kemampuan sistem untuk dimodifikasi dengan mudah tanpa menimbulkan masalah yang baru.'

        ]);
        Atribut::create([
            'atribut' => 'Portability',
            'deskripsi' => 'Karakteristik ini  mewakili tingkat efektivitas dan efisiensi sistem dalam melakukan transfer dari satu perangkat ke perangkat lainnya, termasuk kemudahan instalasi , kemampuan untuk digantikan oleh aplikasi lain dengan fungsi yang sama, dan kemampuan untuk berfungsi dengan baik bersama dengan produk perangkat lunak lainnya di lingkungan bersama tanpa saling mengganggu.'
        ]);
        
    }
}
