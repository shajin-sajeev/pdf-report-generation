<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 2 - Upload Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-xl w-full bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col md:flex-row">
        <div class="md:w-1/3 bg-emerald-600 p-8 text-white flex flex-col justify-between">
            <div>
                <div class="text-emerald-200 text-sm font-bold uppercase tracking-wider mb-2">Step 02</div>
                <h2 class="text-2xl font-bold">Data Import</h2>
            </div>
            <div class="space-y-4 text-sm text-emerald-500">
                <div class="flex items-center gap-2 text-white/50">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                    <span>Visual Reference</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                    <span>Data Integration</span>
                </div>
            </div>
        </div>
        <div class="md:w-2/3 p-10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-slate-800">CSV Dataset</h3>
                <div class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg">{{ session('template_name') }}</div>
            </div>
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('report.generate') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="relative">
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-8 hover:border-emerald-400 transition-colors text-center group cursor-pointer">
                        <input type="file" name="data_csv" accept=".csv" required 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="space-y-2">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center mx-auto text-emerald-600 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="text-slate-600 font-medium">Click to upload CSV</div>
                            <div class="text-slate-400 text-xs">INCLUDE 'REMARK' FOR SMART SORTING</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-emerald-600 transition-all flex items-center justify-center gap-2 group shadow-xl hover:shadow-emerald-200">
                    Generate Report
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                </button>
            </form>
            
            <a href="{{ route('report.step1') }}" class="block text-center mt-6 text-slate-400 text-sm hover:text-indigo-600 transition-colors">
                ← Go back to change template
            </a>
        </div>
    </div>
</body>
</html>
