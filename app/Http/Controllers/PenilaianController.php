<?php

namespace App\Http\Controllers;

use App\Models\PerangkatLunak;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    public function index($id, Request $request)
    {
        $result = $request->get('result');
        $dataPerangkat = PerangkatLunak::with(['metode', 'option'])->findOrFail($id)->toArray();
        
        $data = $result['sentiment_counts'];
        // dd($data);
        
        function getValueOrNull($data, $type, $key) {
            return isset($data[$type][$key]) ? $data[$type][$key] : null;
        }
        
        if ($dataPerangkat['option']['id'] == 1) {
            $chart_data = [
                'labels' => ['Compatability', 'Portability', 'Maintainability'],
                'datasets' => [
                    [
                        'label' => 'Negative',
                        'backgroundColor' => ['#FFD717', '#FFD717', '#FFD717'],
                        'borderColor' => ['#4C789D', '#6D92B8', '#8DAAD3'],
                        'data' => [
                            getValueOrNull($data, 'negative', 'Compatibility'),
                            getValueOrNull($data, 'negative', 'Portability'),
                            getValueOrNull($data, 'negative', 'Maintainability'),
                        ],
                    ],
                    [
                        'label' => 'Positive',
                        'backgroundColor' => ['#0D63A5', '#0D63A5', '#0D63A5'],
                        'borderColor' => ['#70A25B', '#8FBC76', '#AEDD91'],
                        'data' => [
                            getValueOrNull($data, 'positive', 'Compatibility'),
                            getValueOrNull($data, 'positive', 'Portability'),
                            getValueOrNull($data, 'positive', 'Maintainability'),
                        ],
                    ],
                    [
                        'label' => 'Neutral',
                        'backgroundColor' => ['#FFA500', '#FFA500', '#FFA500'],
                        'borderColor' => ['#FFA07A', '#FF8C00', '#FF7F50'],
                        'data' => [
                            getValueOrNull($data, 'neutral', 'Compatibility'),
                            getValueOrNull($data, 'neutral', 'Portability'),
                            getValueOrNull($data, 'neutral', 'Maintainability'),
                        ],
                    ],
                ],
            ];
        } else if ($dataPerangkat['option']['id'] == 2) {
            $chart_data = [
                'labels' => ['Performance', 'Security', 'Reliability'],
                'datasets' => [
                    [
                        'label' => 'Negative',
                        'backgroundColor' => ['#FFD717', '#FFD717', '#FFD717'],
                        'borderColor' => ['#4C789D', '#6D92B8', '#8DAAD3'],
                        'data' => [
                            getValueOrNull($data, 'negative', 'Performance'),
                            getValueOrNull($data, 'negative', 'Security'),
                            getValueOrNull($data, 'negative', 'Reliability'),
                        ],
                    ],
                    [
                        'label' => 'Positive',
                        'backgroundColor' => ['#0D63A5', '#0D63A5', '#0D63A5'],
                        'borderColor' => ['#70A25B', '#8FBC76', '#AEDD91'],
                        'data' => [
                            getValueOrNull($data, 'positive', 'Performance'),
                            getValueOrNull($data, 'positive', 'Security'),
                            getValueOrNull($data, 'positive', 'Reliability'),
                        ],
                    ],
                    [
                        'label' => 'Neutral',
                        'backgroundColor' => ['#FFA500', '#FFA500', '#FFA500'],
                        'borderColor' => ['#FFA07A', '#FF8C00', '#FF7F50'],
                        'data' => [
                            getValueOrNull($data, 'neutral', 'Performance'),
                            getValueOrNull($data, 'neutral', 'Security'),
                            getValueOrNull($data, 'neutral', 'Reliability'),
                        ],
                    ],
                ],
            ];
        } else if ($dataPerangkat['option']['id'] == 3) {
            $chart_data = [
                'labels' => ['Functional Suitability', 'Usability'],
                'datasets' => [
                    [
                        'label' => 'Negative',
                        'backgroundColor' => ['#FFD717', '#FFD717', '#FFD717'],
                        'borderColor' => ['#4C789D', '#6D92B8', '#8DAAD3'],
                        'data' => [
                            getValueOrNull($data, 'negative', 'Functional Suitability'),
                            getValueOrNull($data, 'negative', 'Usability'),
                        ],
                    ],
                    [
                        'label' => 'Positive',
                        'backgroundColor' => ['#0D63A5', '#0D63A5', '#0D63A5'],
                        'borderColor' => ['#70A25B', '#8FBC76', '#AEDD91'],
                        'data' => [
                            getValueOrNull($data, 'positive', 'Functional Suitability'),
                            getValueOrNull($data, 'positive', 'Usability'),
                        ],
                    ],
                    [
                        'label' => 'Neutral',
                        'backgroundColor' => ['#FFA500', '#FFA500', '#FFA500'],
                        'borderColor' => ['#FFA07A', '#FF8C00', '#FF7F50'],
                        'data' => [
                            getValueOrNull($data, 'neutral', 'Functional Suitability'),
                            getValueOrNull($data, 'neutral', 'Usability'),
                        ],
                    ],
                ],
            ];
        } else {
            $chart_data = [
                'labels' => ['Compatability', 'Portability', 'Maintainability', 'Performance', 'Security', 'Reliability', 'Functional Suitability', 'Usability'],
                'datasets' => [
                    [
                        'label' => 'Negative',
                        'backgroundColor' => ['#FFD717', '#FFD717', '#FFD717'],
                        'borderColor' => ['#4C789D', '#6D92B8', '#8DAAD3'],
                        'data' => [
                            getValueOrNull($data, 'negative', 'Compatibility'),
                            getValueOrNull($data, 'negative', 'Portability'),
                            getValueOrNull($data, 'negative', 'Maintainability'),
                            getValueOrNull($data, 'negative', 'Performance'),
                            getValueOrNull($data, 'negative', 'Security'),
                            getValueOrNull($data, 'negative', 'Reliability'),
                            getValueOrNull($data, 'negative', 'Functional Suitability'),
                            getValueOrNull($data, 'negative', 'Usability'),
                        ],
                    ],
                    [
                        'label' => 'Positive',
                        'backgroundColor' => ['#0D63A5', '#0D63A5', '#0D63A5'],
                        'borderColor' => ['#70A25B', '#8FBC76', '#AEDD91'],
                        'data' => [
                            getValueOrNull($data, 'positive', 'Compatibility'),
                            getValueOrNull($data, 'positive', 'Portability'),
                            getValueOrNull($data, 'positive', 'Maintainability'),
                            getValueOrNull($data, 'positive', 'Performance'),
                            getValueOrNull($data, 'positive', 'Security'),
                            getValueOrNull($data, 'positive', 'Reliability'),
                            getValueOrNull($data, 'positive', 'Functional Suitability'),
                            getValueOrNull($data, 'positive', 'Usability'),
                        ],
                    ],
                    [
                        'label' => 'Neutral',
                        'backgroundColor' => ['#FFA500', '#FFA500', '#FFA500'],
                        'borderColor' => ['#FFA07A', '#FF8C00', '#FF7F50'],
                        'data' => [
                            getValueOrNull($data, 'neutral', 'Compatibility'),
                            getValueOrNull($data, 'neutral', 'Portability'),
                            getValueOrNull($data, 'neutral', 'Maintainability'),
                            getValueOrNull($data, 'neutral', 'Performance'),
                            getValueOrNull($data, 'neutral', 'Security'),
                            getValueOrNull($data, 'neutral', 'Reliability'),
                            getValueOrNull($data, 'neutral', 'Functional Suitability'),
                            getValueOrNull($data, 'neutral', 'Usability'),
                        ],
                    ],
                ],
            ];
        }
        
        return view('data.penilaian', compact('chart_data', 'id', 'result'));
    }


    public function downloadPdf($id, Request $request)
    {
        $dataPerangkat = PerangkatLunak::with(['metode', 'option'])->findOrFail($id);
        $data = $dataPerangkat->toArray();
        $chartUrl = $request->input('chartUrl');
        $chartData = json_decode($request->input('chartData'), true);

        $pdf = PDF::loadView('data.document', compact('data', 'chartUrl', 'chartData'));

        return $pdf->download('document.pdf');
    }

    public function saveChart(Request $request)
    {
        $imageData = $request->input('image');
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'chart-' . time() . '.png';

        Storage::disk('public')->put($imageName, base64_decode($image));
        $imageUrl = Storage::url($imageName);

        Log::info('Image saved at: ' . $imageUrl);

        return response()->json(['image_url' => $imageUrl]);
    }
}
