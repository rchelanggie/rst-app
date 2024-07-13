<?php

namespace App\Http\Controllers;

use App\Models\Metode;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    //
    public function informasi(){
        $data = Metode::all();
        return view('informasi.index', [
            'metode' => $data
        ]);
    }
}
