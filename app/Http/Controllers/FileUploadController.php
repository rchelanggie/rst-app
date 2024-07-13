<?php

namespace App\Http\Controllers;

use App\Models\PerangkatLunak;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('data.unggah-data');
    }

    public function update(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'file-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(null, $filename, ['disk' => 'public']);

            $dataAll = session('step2', []); 
            $metode_id = $dataAll['metode_id'] ?? null; 
            // $metode_id = $this->getMethodId();

            // Send file to Flask API
            $client = new Client();
            $response = $client->post('http://localhost:5000/process', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $filename
                    ],
                    [
                        'name' => 'metode_id',
                        'contents' => $metode_id
                    ]
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            $data = array_merge(session('step2'), ['file' => $filename]);

            $perangkatLunak = PerangkatLunak::create($data);

            if ($result) {
                return redirect()->route('penilaian', ['id' => $perangkatLunak->id, 'result' => $result]);
            } else {
                return redirect()->route('file.upload')->with('error', 'Failed to upload file.');
            }
        }
    }

    // private function getMethodId()
    // {
    //     $latestPerangkatLunak = PerangkatLunak::latest()->first();
    //     return $latestPerangkatLunak->metode_id ? $latestPerangkatLunak->metode_id : 1; // Default method_id if no records found
    // }
}
