<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Http\Request;

class FormReqController extends Controller
{
    //
    public function formreq()
    {
        return view('formreq.index', [
        ]);
    }
}
