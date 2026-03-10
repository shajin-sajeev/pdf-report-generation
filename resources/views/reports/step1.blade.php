<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1 - Upload Template</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-xl w-full bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col md:flex-row">
        <div class="md:w-1/3 bg-indigo-600 p-8 text-white flex flex-col justify-between">
            <div>
                <div class="text-indigo-200 text-sm font-bold uppercase tracking-wider mb-2">Step 01</div>
                <h2 class="text-2xl font-bold">Template Setup</h2>
            </div>
            <div class="space-y-4 text-sm text-indigo-100">
                <p>Upload the reference PDF that defines the structure and layout of your report.</p>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
                    <span>Visual Reference</span>
                </div>
                <div class="flex items-center gap-2 opacity-50">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
                    <span>Data Integration</span>
                </div>
            </div>
        </div>
        <div class="md:w-2/3 p-10">
            <h3 class="text-2xl font-bold text-slate-800 mb-6">PDF Template</h3>
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('report.storeTemplate') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="relative">
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-8 hover:border-indigo-400 transition-colors text-center group cursor-pointer">
                        <input type="file" name="template_pdf" accept=".pdf" required 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="space-y-2">
                            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mx-auto text-indigo-600 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            </div>
                            <div class="text-slate-600 font-medium">Click to upload PDF</div>
                            <div class="text-slate-400 text-xs text-nowrap">MAX SIZE 5MB | PDF ONLY</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-indigo-600 transition-all flex items-center justify-center gap-2 group">
                    Continue to Data Upload
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</body>
</html>
