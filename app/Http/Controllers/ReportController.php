<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function showUpload()
    {
        return view('reports.upload');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'data_csv' => 'required|mimes:csv,txt|max:4096',
            'title'    => 'required|string',
            'project'  => 'required|string',
            'client'   => 'required|string',
            'test_type'  => 'required|string',
            'sections' => 'nullable|array',
            'narratives' => 'nullable|array',
            'signature_image' => 'nullable|image|max:2048',
            'seal_image' => 'nullable|image|max:2048',
        ]);
 
        // Process Signature Image to Base64
        $signatureBase64 = null;
        if ($request->hasFile('signature_image')) {
            $image = $request->file('signature_image');
            $signatureBase64 = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image->getRealPath()));
        }
 
        // Process Seal Image to Base64
        $sealBase64 = null;
        if ($request->hasFile('seal_image')) {
            $image = $request->file('seal_image');
            $sealBase64 = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image->getRealPath()));
        }
 
        $csvFile = $request->file('data_csv');
        $csv = Reader::createFromPath($csvFile->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
 
        $mainData = [];
        $releasingData = [];
        $isReleasingMode = false;
 
        foreach ($csv as $record) {
            $remark = '';
            $timeVal = '';
            $normRecord = [];
            
            foreach ($record as $key => $val) {
                $lowKey = strtolower(trim($key));
                if (str_contains($lowKey, 'remark')) {
                    $remark = strtolower($val);
                }
                if (str_contains($lowKey, 'time')) {
                    // Try to normalize to 24-hour
                    try {
                        $timeVal = \Carbon\Carbon::parse($val)->format('H:i');
                    } catch (\Exception $e) {
                        $timeVal = $val;
                    }
                }
            }
            
            // Map the specific columns the user wants for the fixed table
            $normRecord = [
                'date'       => $this->findVal($record, ['date']),
                'time'       => $timeVal ?: $this->findVal($record, ['time']),
                'division'   => $this->findVal($record, ['division', 'div']),
                'load'       => $this->findVal($record, ['load', 'tonnes', 'ton']),
                'dial_a'     => $this->findVal($record, ['dial a', 'dial_a']),
                'dial_b'     => $this->findVal($record, ['dial b', 'dial_b']),
                'dial_c'     => $this->findVal($record, ['dial c', 'dial_c']),
                'dial_d'     => $this->findVal($record, ['dial d', 'dial_d']),
                'average'    => $this->findVal($record, ['average', 'settlement']),
                'remarks'    => $this->findVal($record, ['remark', 'remarks']),
            ];
 
            if (str_contains($remark, 'releasing')) {
                $isReleasingMode = true;
                continue; 
            }
 
            if ($isReleasingMode) {
                $releasingData[] = $normRecord;
            } else {
                $mainData[] = $normRecord;
            }
        }
 
        $chartUrl = $this->generateChartUrl($mainData, $releasingData);
 
        // Pass everything to the view, including the nested sections array
        $pdfData = array_merge($request->all(), [
            'mainData'      => $mainData,
            'releasingData' => $releasingData,
            'chartUrl'      => $chartUrl,
            'reportDate'    => now()->format('d F Y'),
            'sections'      => $request->input('sections', []),
            'narratives'    => $request->input('narratives', []),
            'signature'     => $signatureBase64,
            'seal'          => $sealBase64
        ]);

        $pdf = Pdf::setOption(['isRemoteEnabled' => true])->loadView('reports.pdf_template', $pdfData);

        // Sanitize project title for filename
        $fileName = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $request->project);
        return $pdf->download($fileName . '.pdf');
    }

    private function findVal($record, $needles)
    {
        foreach ($record as $key => $val) {
            $lowKey = strtolower(trim($key));
            foreach ($needles as $needle) {
                if (str_contains($lowKey, $needle)) {
                    return $val;
                }
            }
        }
        return '-';
    }

    private function generateChartUrl($mainData, $releasingData)
    {
        $extract = function($data) {
            $loads = [];
            $settlements = [];
            
            // Define possible column names for Load and Settlement
            $loadKeys = ['load', 'load in tonnes', 'load (tonnes)', 'load in ton', 'tonne', 'tons'];
            $settlementKeys = ['average settlement', 'settlement', 'avg settlement', 'average', 'avg'];

            foreach ($data as $item) {
                $foundLoad = null;
                $foundSettlement = null;

                foreach ($item as $key => $val) {
                    $lowKey = strtolower(trim($key));
                    
                    if ($foundLoad === null) {
                        foreach ($loadKeys as $lk) {
                            if (str_contains($lowKey, $lk)) {
                                $foundLoad = (float)$val;
                                break;
                            }
                        }
                    }

                    if ($foundSettlement === null) {
                        foreach ($settlementKeys as $sk) {
                            if (str_contains($lowKey, $sk)) {
                                $foundSettlement = (float)$val;
                                break;
                            }
                        }
                    }
                }

                if ($foundLoad !== null && $foundSettlement !== null) {
                    $loads[] = $foundLoad;
                    $settlements[] = $foundSettlement;
                }
            }
            return [$loads, $settlements];
        };

        [$mainLoads, $mainSets] = $extract($mainData);
        [$releaseLoads, $releaseSets] = $extract($releasingData);

        // QuickChart configuration
        $chartConfig = [
            'type' => 'line',
            'data' => [
                'datasets' => [
                    [
                        'label' => 'Average Settlement',
                        'data' => array_map(fn($l, $v) => ['x' => $l, 'y' => $v], $mainLoads, $mainSets),
                        'borderColor' => '#4f46e5',
                        'backgroundColor' => 'transparent',
                        'borderWidth' => 3,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => '#4f46e5',
                        'fill' => false,
                        'datalabels' => ['align' => 'top', 'anchor' => 'end', 'color' => '#4f46e5', 'font' => ['size' => 10, 'weight' => 'bold']]
                    ],
                    [
                        'label' => 'Release',
                        'data' => array_map(fn($l, $v) => ['x' => $l, 'y' => $v], $releaseLoads, $releaseSets),
                        'borderColor' => '#06b6d4',
                        'backgroundColor' => 'transparent',
                        'borderWidth' => 3,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => '#06b6d4',
                        'fill' => false,
                        'datalabels' => ['align' => 'bottom', 'anchor' => 'start', 'color' => '#06b6d4', 'font' => ['size' => 10, 'weight' => 'bold']]
                    ]
                ]
            ],
            'options' => [
                'title' => [
                    'display' => true, 
                    'text' => 'Load vs Settlement Graph', 
                    'fontSize' => 32, 
                    'fontColor' => '#000',
                    'fontStyle' => 'bold'
                ],
                'legend' => ['position' => 'top', 'labels' => ['fontSize' => 18, 'fontStyle' => 'bold']],
                'scales' => [
                    'xAxes' => [[
                        'type' => 'linear',
                        'position' => 'bottom',
                        'scaleLabel' => ['display' => true, 'labelString' => 'Load in Ton', 'fontSize' => 20, 'fontStyle' => 'bold'],
                        'gridLines' => ['color' => '#cbd5e1', 'lineWidth' => 1],
                        'ticks' => ['fontSize' => 16, 'fontStyle' => 'bold']
                    ]],
                    'yAxes' => [[
                        'scaleLabel' => ['display' => true, 'labelString' => 'Settlement (mm)', 'fontSize' => 20, 'fontStyle' => 'bold'],
                        'gridLines' => ['color' => '#cbd5e1', 'lineWidth' => 1],
                        'ticks' => ['reverse' => true, 'fontSize' => 16, 'fontStyle' => 'bold']
                    ]]
                ],
                'plugins' => [
                    'datalabels' => [
                        'display' => true,
                        'backgroundColor' => 'white',
                        'borderColor' => '#cbd5e1',
                        'borderWidth' => 1,
                        'borderRadius' => 4,
                        'padding' => 6,
                        'font' => ['weight' => 'bold', 'size' => 14],
                        'color' => '#000'
                    ]
                ]
            ]
        ];

        // Using very high resolution and devicePixelRatio for "Retina" sharpness in PDF
        return 'https://quickchart.io/chart?w=1200&h=800&devicePixelRatio=2&c=' . urlencode(json_encode($chartConfig));
    }
}
