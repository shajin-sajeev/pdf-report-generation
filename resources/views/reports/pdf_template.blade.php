<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 60px 40px 60px 40px; }
        footer { position: fixed; bottom: -40px; left: 0px; right: 0px; height: 30px; text-align: center; font-size: 9px; color: #64748b; border-top: 1px solid #e2e8f0; padding-top: 5px; }
        .page-number:after { content: counter(page); }

        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1e293b; line-height: 1.4; font-size: 11.5px; margin: 0; padding: 0; }
        
        .report-title { text-align: center; margin-bottom: 20px; border-bottom: 3px solid #1e3a8a; padding: 12px 0; }
        .report-title h1 { margin: 0; font-size: 22px; font-weight: 900; color: #1e3a8a; text-transform: uppercase; letter-spacing: -0.5px; }

        .metadata-box { background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px 15px; margin-bottom: 15px; border-radius: 4px; }
        .metadata-box table { width: 100%; border-collapse: collapse; }
        .metadata-box td.label { font-weight: bold; width: 150px; color: #475569; padding: 2px 0; font-size: 10px; }
        .metadata-box td.val { color: #0f172a; padding: 2px 0; font-weight: 500; }

        .section-header { font-size: 11px; font-weight: 800; margin-top: 12px; margin-bottom: 6px; text-transform: uppercase; background: #e2e8f0; padding: 4px 10px; border-left: 5px solid #1e3a8a; color: #1e3a8a; }
        .narrative { text-align: justify; margin-bottom: 10px; color: #334155; line-height: 1.4; font-size: 11px; }

        /* Dynamic Tables */
        table.dynamic-table { width: 100%; border-collapse: collapse; margin-bottom: 12px; table-layout: fixed; }
        table.dynamic-table th { border: 1px solid #cbd5e1; padding: 3px 2px; font-weight: bold; text-align: center; font-size: 8.5px; color: #1e293b; text-transform: uppercase; }
        table.dynamic-table td { border: 1px solid #cbd5e1; padding: 3px 2px; font-size: 9.5px; text-align: center; color: #1e293b; }
        
        table.log-table { table-layout: fixed; margin-top: 10px; }
        
        /* Chart Section */
        .chart-block { text-align: center; margin: 15px 0; page-break-inside: avoid; }
        .chart-block img { max-width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; }

        .page-break { page-break-after: always; }
        .text-releasing { color: #dc2626; font-weight: bold; }
        
        .signature-section { margin-top: 35px; page-break-inside: avoid; border-top: 1px solid #e2e8f0; padding-top: 20px; position: relative; height: 150px; }
        .signature-left { position: absolute; left: 0; bottom: 0; text-align: left; }
        .signature-right { position: absolute; right: 0; bottom: 0; text-align: right; }
    </style>
</head>
<body>
    <footer>
        Precision Geotechnical Engineering &bull; {{ $project }} &bull; Page <span class="page-number"></span>
    </footer>

    <div class="report-title">
        <h1>{{ $title }}</h1>
    </div>

    <div class="metadata-box">
        <table>
            <tr><td class="label">PROJECT:</td><td class="val">{{ $project }}</td></tr>
            <tr><td class="label">CLIENT:</td><td class="val">{{ $client }}</td></tr>
            @if($contractor)
                <tr><td class="label">CONTRACTOR:</td><td class="val">{{ $contractor }}</td></tr>
            @endif
            <tr><td class="label">TYPE OF TEST:</td><td class="val">{{ $test_type }}</td></tr>
            <tr><td class="label">REPORT DATE:</td><td class="val">{{ $reportDate }}</td></tr>
        </table>
    </div>

    @if($introduction)
        <div class="section-header">1. Introduction</div>
        <div class="narrative">{{ $introduction }}</div>
    @endif

    @if($field_investigation)
        <div class="section-header">2. Field Investigation</div>
        <div class="narrative">{{ $field_investigation }}</div>
    @endif

    @if($test_procedure)
        <div class="section-header">3. Procedure for Test</div>
        <div class="narrative">{{ $test_procedure }}</div>
    @endif

    @foreach($sections as $section)
        <div class="section-header">{{ $section['title'] }}</div>
        <table class="dynamic-table">
            <thead>
                <tr>
                    @php $colCount = count($section['headers'] ?? []); @endphp
                    @foreach($section['headers'] ?? [] as $header)
                        <th style="width: {{ 100 / max(1, $colCount) }}%">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($section['rows'] ?? [] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="page-break"></div>

    <div class="section-header">TEST LOG DATA (PRIMARY PHASE)</div>
    <table class="dynamic-table log-table">
        <thead>
            <tr>
                <th style="width: 10%">DATE</th>
                <th style="width: 8%">TIME</th>
                <th style="width: 9%">DIVISION</th>
                <th style="width: 9%">LOAD (T)</th>
                <th style="width: 8%">DIAL A</th>
                <th style="width: 8%">DIAL B</th>
                <th style="width: 8%">DIAL C</th>
                <th style="width: 8%">DIAL D</th>
                <th style="width: 14%">AVG SETTLE.</th>
                <th style="width: 18%">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mainData as $row)
                <tr>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['time'] }}</td>
                    <td>{{ $row['division'] }}</td>
                    <td>{{ $row['load'] }}</td>
                    <td>{{ $row['dial_a'] }}</td>
                    <td>{{ $row['dial_b'] }}</td>
                    <td>{{ $row['dial_c'] }}</td>
                    <td>{{ $row['dial_d'] }}</td>
                    <td>{{ $row['average'] }}</td>
                    <td>{{ $row['remarks'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(count($releasingData) > 0)
        <div class="section-header">RELEASING PHASE OBSERVATIONS</div>
        <table class="dynamic-table log-table">
            <thead>
                <tr>
                    <th style="width: 10%">DATE</th>
                    <th style="width: 8%">TIME</th>
                    <th style="width: 9%">DIVISION</th>
                    <th style="width: 9%">LOAD (T)</th>
                    <th style="width: 8%">DIAL A</th>
                    <th style="width: 8%">DIAL B</th>
                    <th style="width: 8%">DIAL C</th>
                    <th style="width: 8%">DIAL D</th>
                    <th style="width: 14%">AVG SETTLE.</th>
                    <th style="width: 18%">REMARKS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($releasingData as $row)
                    <tr>
                        <td class="text-releasing">{{ $row['date'] }}</td>
                        <td class="text-releasing">{{ $row['time'] }}</td>
                        <td class="text-releasing">{{ $row['division'] }}</td>
                        <td class="text-releasing">{{ $row['load'] }}</td>
                        <td class="text-releasing">{{ $row['dial_a'] }}</td>
                        <td class="text-releasing">{{ $row['dial_b'] }}</td>
                        <td class="text-releasing">{{ $row['dial_c'] }}</td>
                        <td class="text-releasing">{{ $row['dial_d'] }}</td>
                        <td class="text-releasing">{{ $row['average'] }}</td>
                        <td class="text-releasing">{{ $row['remarks'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="page-break"></div>
    <div class="section-header">STRESS-STRAIN ANALYSIS GRAPH</div>
    <div class="chart-block" style="margin-top: 10px;">
        <img src="{{ $chartUrl }}" style="width: 100%; height: auto;" alt="Analysis Curve">
    </div>

    @if($conclusion)
        <div class="section-header">CONCLUSION</div>
        <div class="narrative">{{ $conclusion }}</div>
    @endif

    @if($signature || $seal)
        <div class="signature-section">
            <!-- Signature on the left edge -->
            @if($signature)
                <div class="signature-left">
                    <img src="{{ $signature }}" style="max-width: 250px; max-height: 150px;" alt="Authorized Signature">
                </div>
            @endif
            
            <!-- Seal on the right edge -->
            @if($seal)
                <div class="signature-right">
                    <img src="{{ $seal }}" style="max-width: 250px; max-height: 150px;" alt="Official Seal">
                </div>
            @endif
        </div>
    @endif

</body>
</html>
