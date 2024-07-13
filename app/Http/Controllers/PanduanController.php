<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    //
    public function index()
    {
        $data = Panduan::all();
        return view('panduan.index', [
            'data' => $data
        ]);
    }
}
