<?php

namespace App\Http\Controllers;

use App\Models\Atribut;
use App\Models\AtributeOption;
use App\Models\Metode;
use App\Models\Option;
use App\Models\PerangkatLunak;
use Illuminate\Http\Request;

class AtributController extends Controller
{
    //
    public function index()
    {
        $metode = Metode::all();
        $atribut = Option::all();
        $atributDescriptions = Atribut::whereIn('atribut', [
            'Compatibility', 'Portability', 'Maintainability',
            'Performance Efficiency', 'Security', 'Reliability',
            'Functional Suitability', 'Usability'
        ])->pluck('deskripsi', 'atribut')->toArray();

        return view('data.metode-atribut', compact('metode', 'atribut', 'atributDescriptions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'metode_id' => 'required',
            'option_id' => 'required',
        ]);

        $data = array_merge(session('step1'), $request->only('metode_id', 'option_id'));

        session([
            'step2' => $data
        ]);

        return redirect()->route('file.upload');
    }
}
