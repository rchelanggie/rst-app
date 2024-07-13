<?php

namespace App\Http\Controllers;

use App\Models\PerangkatLunak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PerangkatLunakController extends Controller
{
    //
    public function create()
    {
        return view('data.create-data');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'informasi' => 'required',
            'deskripsi' => 'required',
            'developer' => 'required',
        ]);

        session([
            'step1' => $request->only('nama', 'informasi', 'deskripsi', 'developer')
        ]);

        return redirect()->route('metode')->with('add_perangkat_lunak', 'Penambahan Data berhasil');
    }

    public function downloadCsv()
    {
        $filePath = public_path('file-template.csv');
        return Response::download($filePath, 'file-template.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}
