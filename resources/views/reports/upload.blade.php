<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Report Studio v5.0</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0f172a; }
        .glass-card { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .input-accent { background: rgba(15, 23, 42, 0.5); border: 1px solid #334155; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .input-accent:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; }
        .section-header-gradient { background: linear-gradient(90deg, #6366f1 0%, #a855f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="min-h-screen p-6 md:p-12 text-slate-200" x-data="reportApp()">
    <div class="max-w-6xl mx-auto space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-700">
        
        <header class="text-center space-y-4">
            <h1 class="text-6xl font-black section-header-gradient tracking-tighter">Precision Report Engine</h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto text-balance">Create highly customized geotechnical reports with dynamic multi-set technical sections.</p>
        </header>

        <form action="{{ route('report.generate') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Project Identity -->
            <div class="glass-card p-10 rounded-[2.5rem] shadow-2xl space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-100 uppercase tracking-tighter">Project Profile</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest px-1">Report Title</label>
                        <input type="text" name="title" required value="Pile Load Test Report" class="w-full p-5 rounded-2xl input-accent text-slate-200 font-semibold text-lg">
                    </div>
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest px-1">Project Name</label>
                        <input type="text" name="project" required placeholder="Enter Project Reference" class="w-full p-5 rounded-2xl input-accent text-slate-200 font-semibold text-lg">
                    </div>
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest px-1">Client Name</label>
                        <input type="text" name="client" required placeholder="Stakeholder Name" class="w-full p-5 rounded-2xl input-accent text-slate-200 font-semibold text-lg">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest px-1">Contractor (Optional)</label>
                            <input type="text" name="contractor" placeholder="Contracting Entity" class="w-full p-5 rounded-2xl input-accent text-slate-200 font-semibold text-lg">
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest px-1">Type of Test</label>
                            <input type="text" name="test_type" required value="Initial Pile Load Test" class="w-full p-5 rounded-2xl input-accent text-slate-200 font-semibold text-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Recursive Technical Parameters -->
            <div class="glass-card p-10 rounded-[2.5rem] shadow-2xl space-y-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-400">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <h2 class="text-3xl font-black text-slate-100 uppercase tracking-tighter">Technical Parameters</h2>
                    </div>
                    <button type="button" @click="addSection()" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-2xl font-black flex items-center gap-2 transition-all shadow-xl shadow-indigo-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        Add New Section
                    </button>
                </div>

                <div class="space-y-12">
                    <template x-for="(section, sIndex) in sections" :key="sIndex">
                        <div class="bg-slate-800/40 rounded-3xl p-8 border border-slate-700/50 space-y-8 animate-in slide-in-from-right-4 duration-300 relative group">
                            
                            <!-- Remove Section Button -->
                            <button type="button" @click="removeSection(sIndex)" class="absolute top-4 right-4 text-slate-500 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </button>

                            <div class="space-y-6">
                                <div class="w-full md:w-1/2 space-y-2">
                                    <label class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest pl-1">Section Title</label>
                                    <input type="text" :name="'sections['+sIndex+'][title]'" x-model="section.title" placeholder="e.g. 4. Kentledge Details" class="w-full p-4 rounded-xl input-accent text-slate-100 font-bold border-indigo-500/20">
                                </div>

                                <!-- Dynamic Columns -->
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between px-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Table Columns</span>
                                            <span class="bg-slate-700 text-[10px] px-2 py-0.5 rounded text-slate-300 font-mono" x-text="section.headers.length"></span>
                                        </div>
                                        <button type="button" @click="addColumn(sIndex)" class="text-indigo-400 hover:text-indigo-300 text-xs font-bold flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            Add Column
                                        </button>
                                    </div>
                                    <div class="flex flex-wrap gap-4">
                                        <template x-for="(header, hIndex) in section.headers" :key="hIndex">
                                            <div class="flex items-center gap-2 bg-slate-900/50 p-2 rounded-xl border border-slate-700">
                                                <input type="text" :name="'sections['+sIndex+'][headers]['+hIndex+']'" x-model="section.headers[hIndex]" class="bg-transparent border-none text-xs font-bold text-slate-300 w-32 focus:ring-0" placeholder="Heading">
                                                <button type="button" @click="removeColumn(sIndex, hIndex)" x-show="section.headers.length > 1" class="text-slate-600 hover:text-red-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Dynamic Rows -->
                                <div class="space-y-4 pt-4 border-t border-slate-700/30">
                                    <div class="flex items-center justify-between px-1">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Table Rows</span>
                                        <button type="button" @click="addRow(sIndex)" class="text-emerald-400 hover:text-emerald-300 text-xs font-bold flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            Add Row
                                        </button>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <template x-for="(row, rIndex) in section.rows" :key="rIndex">
                                            <div class="flex items-center gap-3 animate-in slide-in-from-left-4">
                                                <template x-for="(cell, cIndex) in row" :key="cIndex">
                                                    <input type="text" :name="'sections['+sIndex+'][rows]['+rIndex+']['+cIndex+']'" x-model="section.rows[rIndex][cIndex]" class="flex-1 p-3 rounded-xl input-accent text-sm" placeholder="Value">
                                                </template>
                                                <button type="button" @click="removeRow(sIndex, rIndex)" class="text-slate-600 hover:text-red-500 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Narrative Content -->
            <div class="glass-card p-10 rounded-[2.5rem] shadow-2xl space-y-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-100 uppercase tracking-tighter">Narrative Content</h2>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    <div class="space-y-2"><label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Introduction</label><textarea name="introduction" rows="3" class="w-full p-6 rounded-[2rem] input-accent text-sm leading-relaxed" placeholder="Background and objectives..."></textarea></div>
                    <div class="space-y-2"><label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Field Investigation</label><textarea name="field_investigation" rows="3" class="w-full p-6 rounded-[2rem] input-accent text-sm leading-relaxed" placeholder="Site observations..."></textarea></div>
                    <div class="space-y-2"><label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Procedure for Test</label><textarea name="test_procedure" rows="3" class="w-full p-6 rounded-[2rem] input-accent text-sm leading-relaxed" placeholder="Technical methodology..."></textarea></div>
                    <div class="space-y-2"><label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Conclusion</label><textarea name="conclusion" rows="3" class="w-full p-6 rounded-[2rem] input-accent text-sm leading-relaxed" placeholder="Summary and results..."></textarea></div>
                </div>
            </div>

            <!-- CSV Upload -->
            <div class="glass-card p-10 rounded-[2.5rem] shadow-2xl space-y-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-100 uppercase tracking-tighter">Dynamic Test Log CSV</h2>
                </div>
                <div class="relative border-2 border-dashed border-slate-700 rounded-[2.5rem] p-16 text-center bg-slate-800/50 hover:border-emerald-500/50 transition-all cursor-pointer group">
                    <input type="file" name="data_csv" accept=".csv" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="space-y-4">
                        <div class="w-20 h-20 bg-emerald-500/10 rounded-3xl flex items-center justify-center mx-auto text-emerald-400 group-hover:scale-110 transition-transform">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="text-slate-100 font-black text-2xl tracking-tight">Drop Test Log CSV</div>
                    </div>
                </div>
            </div>

            <!-- Authorized Signature & Seal -->
            <div class="glass-card p-10 rounded-[2.5rem] shadow-2xl space-y-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-100 uppercase tracking-tighter">Authorized Signature & Seal</h2>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Signature Upload -->
                    <div class="relative border-2 border-dashed border-slate-700 rounded-[2.5rem] p-8 text-center bg-slate-800/50 hover:border-blue-500/50 transition-all cursor-pointer group">
                        <input type="file" name="signature_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-blue-500/10 rounded-3xl flex items-center justify-center mx-auto text-blue-400 group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </div>
                            <div class="text-slate-100 font-bold text-xl tracking-tight">Authorized Signature</div>
                            <p class="text-slate-500 text-sm">PNG or JPG preferred</p>
                        </div>
                    </div>
                    
                    <!-- Seal Upload -->
                    <div class="relative border-2 border-dashed border-slate-700 rounded-[2.5rem] p-8 text-center bg-slate-800/50 hover:border-blue-500/50 transition-all cursor-pointer group">
                        <input type="file" name="seal_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-purple-500/10 rounded-3xl flex items-center justify-center mx-auto text-purple-400 group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="text-slate-100 font-bold text-xl tracking-tight">Official Seal</div>
                            <p class="text-slate-500 text-sm">PNG or JPG preferred</p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full py-8 px-12 bg-indigo-600 text-white rounded-[2.5rem] font-black text-3xl hover:bg-indigo-500 transform hover:scale-[1.01] transition-all shadow-2xl flex items-center justify-center gap-5">
                Generate Precision Report
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>

    <script>
        function reportApp() {
            return {
                sections: [
                    {
                        title: '4. Kentledge Details',
                        headers: ['Component', 'Specification'],
                        rows: [
                            ['ISMB Beams', 'ISMB 300, 6 m length × 6 nos'],
                            ['Concrete Blocks', '24 blocks × 2.5 Tons = 60 Tons'],
                            ['Beam Self-Weight', '16.6 Tons approx'],
                            ['Total Reaction Load', '≈ 62.766 Tons']
                        ]
                    },
                    {
                        title: '5. Hydraulic Jack Details',
                        headers: ['Parameter', 'Specification'],
                        rows: [
                            ['Capacity', '100 MT'],
                            ['Ram Diameter', '160 mm'],
                            ['Ram Area', '200.96 cm²']
                        ]
                    }
                ],
                addSection() {
                    this.sections.push({
                        title: 'New Section',
                        headers: ['Column 1', 'Column 2'],
                        rows: [['', '']]
                    });
                },
                removeSection(index) {
                    this.sections.splice(index, 1);
                },
                addColumn(sIndex) {
                    this.sections[sIndex].headers.push('New Column');
                    this.sections[sIndex].rows.forEach(row => row.push(''));
                },
                removeColumn(sIndex, hIndex) {
                    if (this.sections[sIndex].headers.length > 1) {
                        this.sections[sIndex].headers.splice(hIndex, 1);
                        this.sections[sIndex].rows.forEach(row => row.splice(hIndex, 1));
                    }
                },
                addRow(sIndex) {
                    const colCount = this.sections[sIndex].headers.length;
                    this.sections[sIndex].rows.push(new Array(colCount).fill(''));
                },
                removeRow(sIndex, rIndex) {
                    this.sections[sIndex].rows.splice(rIndex, 1);
                }
            }
        }
    </script>
</body>
</html>
