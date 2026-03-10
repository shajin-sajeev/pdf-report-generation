<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReportGen - Professional Enterprise Reporting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .hero-gradient { background: radial-gradient(circle at top right, #4f46e5 0%, #0f172a 100%); }
    </style>
</head>
<body class="bg-slate-950 text-white min-h-screen">
    <div class="hero-gradient min-h-screen flex flex-col items-center justify-center text-center px-6">
        <div class="max-w-4xl space-y-8 animate-in fade-in slide-in-from-bottom-10 duration-1000">
            <div class="inline-block px-4 py-1.5 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-indigo-400 text-sm font-semibold mb-4">
                Now with AI-Powered Visuals
            </div>
            <h1 class="text-6xl md:text-8xl font-black tracking-tight leading-tight">
                Transform Data into <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Insights</span>
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Generate professional, high-fidelity PDF reports from your CSV data using custom templates. Smart sorting, automated charting, and enterprise-grade formatting.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-8">
                <a href="{{ route('report.step1') }}" class="group relative px-8 py-4 bg-indigo-600 rounded-2xl font-bold text-lg hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-600/20 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2">
                        Get Started <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
                <a href="#" class="px-8 py-4 bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl font-bold text-lg hover:bg-slate-700 transition-all">
                    View Samples
                </a>
            </div>
        </div>
        
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl w-full text-left">
            <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-slate-700 transition-all hover:bg-slate-800/50">
                <div class="w-12 h-12 bg-indigo-600/20 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Automated Charts</h3>
                <p class="text-slate-400">Instantly generate bar and line charts directly within your PDF reports from CSV datasets.</p>
            </div>
            <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-slate-700 transition-all hover:bg-slate-800/50">
                <div class="w-12 h-12 bg-cyan-600/20 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Smart Grouping</h3>
                <p class="text-slate-400">Detect "Releasing" remarks to automatically split and organize your maintenance data tables.</p>
            </div>
            <div class="p-8 rounded-3xl bg-slate-900/50 border border-slate-800 hover:border-slate-700 transition-all hover:bg-slate-800/50">
                <div class="w-12 h-12 bg-emerald-600/20 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Template Driven</h3>
                <p class="text-slate-400">Upload your PDF reference once and generate consistent reports that align with your standards.</p>
            </div>
        </div>
    </div>
</body>
</html>
