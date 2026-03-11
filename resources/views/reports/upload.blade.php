@extends('layouts.app')

@section('title', 'Report Studio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12" x-data="reportApp()">
    <div class="space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-700">
        
        <header class="flex flex-col md:flex-row justify-between items-end gap-6">
            <div class="space-y-3">
                <h1 class="text-6xl font-black brand-gradient-text tracking-tighter uppercase">Report Studio</h1>
                <p class="text-slate-400 text-xl font-medium tracking-tight italic">Precision parameters for geotechnical report generation.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-secondary group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Return to Dashboard
            </a>
        </header>

        <form action="{{ route('report.generate') }}" method="POST" enctype="multipart/form-data" class="space-y-16">
            @csrf

            <!-- Section 1: Project Identity -->
            <div class="card-premium p-12 space-y-12 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary-50 rounded-full blur-3xl -mr-32 -mt-32 opacity-50"></div>
                
                <div class="flex items-center gap-6 relative z-10">
                    <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm border border-primary-100/50">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h2 class="text-4xl font-black text-slate-800 tracking-tighter uppercase">Project Profile</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10">
                    <div class="space-y-4">
                        <label class="text-xs font-black text-primary-600 uppercase tracking-widest px-1">Report Title</label>
                        <input type="text" name="title" required value="Pile Load Test Report" class="input-premium text-xl font-black">
                    </div>
                    <div class="space-y-4">
                        <label class="text-xs font-black text-primary-600 uppercase tracking-widest px-1">Project Name</label>
                        <input type="text" name="project" required placeholder="Enter Project Reference" class="input-premium text-xl font-black">
                    </div>
                    <div class="space-y-4">
                        <label class="text-xs font-black text-primary-600 uppercase tracking-widest px-1">Client Name</label>
                        <input type="text" name="client" required placeholder="Stakeholder Name" class="input-premium text-xl font-black">
                    </div>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Contractor</label>
                            <input type="text" name="contractor" placeholder="Optional" class="input-premium text-xl font-black text-slate-400">
                        </div>
                        <div class="space-y-4">
                            <label class="text-xs font-black text-primary-600 uppercase tracking-widest px-1">Type of Test</label>
                            <input type="text" name="test_type" required value="Initial Pile Load Test" class="input-premium text-xl font-black">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Narrative Content (Unified Dynamic) -->
            <div class="card-premium p-12 space-y-16 overflow-hidden relative">
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm border border-primary-100/50">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <h2 class="text-4xl font-black text-slate-800 tracking-tighter uppercase">Narrative Content</h2>
                    </div>
                    <button type="button" @click="addNarrative()" class="btn-primary py-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4"/></svg>
                        Add Narrative Section
                    </button>
                </div>

                <div class="space-y-12 relative z-10">
                    <template x-for="(narrative, nIndex) in narratives" :key="nIndex">
                        <div class="bg-slate-50 rounded-[3rem] p-10 border border-slate-100 space-y-10 animate-in zoom-in-95 duration-500 relative group">
                            
                            <button type="button" @click="removeNarrative(nIndex)" class="absolute top-8 right-8 text-slate-300 hover:text-red-500 transition-all p-2 hover:bg-white rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>

                            <div class="space-y-8">
                                <div class="w-full md:w-2/3 space-y-3">
                                    <label class="text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] pl-1">Section Title</label>
                                    <input type="text" :name="'narratives['+nIndex+'][title]'" x-model="narrative.title" class="input-premium py-4 font-black bg-white border-slate-100 italic" placeholder="Enter Title">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Section Content</label>
                                    <textarea :name="'narratives['+nIndex+'][content]'" x-model="narrative.content" rows="6" class="input-premium bg-white border-slate-100 rounded-[2rem] text-sm font-bold italic" placeholder="Enter findings, observations or details..."></textarea>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Section 3: Recursive Technical Parameters -->
            <div class="card-premium p-12 space-y-16">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm border border-primary-100/50">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <h2 class="text-4xl font-black text-slate-800 tracking-tighter uppercase">Technical Parameters</h2>
                    </div>
                    <button type="button" @click="addSection()" class="btn-primary py-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4"/></svg>
                        Add New Section
                    </button>
                </div>

                <div class="space-y-16">
                    <template x-for="(section, sIndex) in sections" :key="sIndex">
                        <div class="bg-slate-50 rounded-[3rem] p-10 border border-slate-100 space-y-12 animate-in zoom-in-95 duration-500 relative group">
                            
                            <button type="button" @click="removeSection(sIndex)" class="absolute top-8 right-8 text-slate-300 hover:text-red-500 transition-all p-2 hover:bg-white rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>

                            <div class="space-y-10">
                                <div class="w-full md:w-2/3 space-y-3">
                                    <label class="text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] pl-1">Section Title</label>
                                    <input type="text" :name="'sections['+sIndex+'][title]'" x-model="section.title" placeholder="e.g. 4. Kentledge Details" class="input-premium py-4 font-black bg-white border-slate-100 italic text-slate-800">
                                </div>

                                <!-- Dynamic Columns -->
                                <div class="space-y-6">
                                    <div class="flex items-center justify-between px-1">
                                        <div class="flex items-center gap-4">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Table Columns</span>
                                            <span class="bg-primary-100 text-primary-600 text-[10px] px-3 py-1 rounded-full font-black" x-text="section.headers.length"></span>
                                        </div>
                                        <button type="button" @click="addColumn(sIndex)" class="text-primary-600 hover:text-primary-700 text-xs font-black flex items-center gap-2 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            ADD COLUMN
                                        </button>
                                    </div>
                                    <div class="flex flex-wrap gap-5">
                                        <template x-for="(header, hIndex) in section.headers" :key="hIndex">
                                            <div class="flex items-center gap-4 bg-white p-3 rounded-2xl border border-slate-100 shadow-sm transition-all focus-within:border-primary-200 focus-within:ring-4 focus-within:ring-primary-50">
                                                <input type="text" :name="'sections['+sIndex+'][headers]['+hIndex+']'" x-model="section.headers[hIndex]" class="bg-transparent border-none text-xs font-black text-slate-800 w-40 focus:ring-0" placeholder="Heading">
                                                <button type="button" @click="removeColumn(sIndex, hIndex)" x-show="section.headers.length > 1" class="text-slate-300 hover:text-red-500 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Dynamic Rows -->
                                <div class="space-y-6 pt-12 border-t border-slate-100">
                                    <div class="flex items-center justify-between px-1">
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Table Rows</span>
                                        <button type="button" @click="addRow(sIndex)" class="text-primary-600 hover:text-primary-700 text-xs font-black flex items-center gap-2 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            ADD ROW
                                        </button>
                                    </div>
                                    
                                    <div class="space-y-5">
                                        <template x-for="(row, rIndex) in section.rows" :key="rIndex">
                                            <div class="flex items-center gap-5 animate-in slide-in-from-left-4 group/row">
                                                <template x-for="(cell, cIndex) in row" :key="cIndex">
                                                    <input type="text" :name="'sections['+sIndex+'][rows]['+rIndex+']['+cIndex+']'" x-model="section.rows[rIndex][cIndex]" class="flex-1 p-5 rounded-2xl bg-white border border-slate-100 focus:ring-4 focus:ring-primary-50 focus:border-primary-200 outline-none text-sm font-bold text-slate-800 transition-all shadow-sm" placeholder="Value">
                                                </template>
                                                <button type="button" @click="removeRow(sIndex, rIndex)" class="text-slate-200 group-hover/row:text-red-300 hover:text-red-500 transition-all p-2">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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

            <!-- Section 4: Dynamic Test Log CSV -->
            <div class="card-premium p-12 space-y-12 overflow-hidden relative">
                <div class="flex items-center gap-6 relative z-10">
                    <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm border border-primary-100/50">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h2 class="text-4xl font-black text-slate-800 tracking-tighter uppercase">Dynamic Test Log</h2>
                </div>
                <div class="relative border-4 border-dashed border-slate-100 rounded-[3.5rem] p-24 text-center hover:border-primary-200 hover:bg-slate-50 transition-all duration-700 cursor-pointer group z-10">
                    <input type="file" name="data_csv" accept=".csv" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    <div class="space-y-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-accent-500 rounded-[2.5rem] flex items-center justify-center mx-auto text-white group-hover:scale-110 group-hover:rotate-6 transition-transform shadow-2xl shadow-primary-500/20">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="space-y-2">
                            <div class="text-slate-900 font-black text-3xl tracking-tight uppercase">Upload Dataset CSV</div>
                            <p class="text-slate-400 font-black uppercase tracking-widest text-[10px]">Supports geotechnical drop test logs</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Assets -->
            <div class="card-premium p-12 space-y-12">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm border border-primary-100/50">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </div>
                    <h2 class="text-4xl font-black text-slate-800 tracking-tighter uppercase">Verification Assets</h2>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Signature Upload -->
                    <div class="relative border-4 border-dashed border-slate-100 rounded-[3rem] p-12 text-center hover:border-primary-200 transition-all duration-500 group">
                        <input type="file" name="signature_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-6">
                            <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto text-slate-300 group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </div>
                            <div class="space-y-2">
                                <div class="text-slate-800 font-black text-2xl tracking-tight uppercase underline decoration-primary-200 decoration-4 underline-offset-8">Authorized Sign</div>
                                <p class="text-slate-400 text-[10px] font-black tracking-widest uppercase">PNG or JPG preferred</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Seal Upload -->
                    <div class="relative border-4 border-dashed border-slate-100 rounded-[3rem] p-12 text-center hover:border-primary-200 transition-all duration-500 group">
                        <input type="file" name="seal_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-6">
                            <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto text-slate-300 group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="space-y-2">
                                <div class="text-slate-800 font-black text-2xl tracking-tight uppercase underline decoration-primary-200 decoration-4 underline-offset-8">Official Seal</div>
                                <p class="text-slate-400 text-[10px] font-black tracking-widest uppercase">PNG or JPG preferred</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full py-12 text-5xl rounded-[3rem] shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-accent-600 group-hover:scale-105 transition-transform duration-500"></div>
                <span class="relative z-10 flex items-center justify-center gap-8">
                    Generate Report
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </span>
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function reportApp() {
        return {
            narratives: [
                { title: '1. Introduction', content: 'This report presents the results of the Pile Load Test conducted at the project site to verify the design capacity of the pile.' },
                { title: '2. Field Investigation', content: 'The field investigation involved the installation of test piles and the setup of the loading platform according to technical specifications.' },
                { title: '3. Procedure for Test', content: 'The test was conducted using the maintained load method as per relevant standards, with load applied in 25% increments.' },
                { title: 'Conclusion', content: 'Based on the analysis of the load-settlement data, the test pile successfully sustained the maximum test load with settlements within permissible limits.' }
            ],
            sections: [
                {
                    title: 'Kentledge Details',
                    headers: ['Component', 'Specification'],
                    rows: [
                        ['ISMB Beams', 'ISMB 300, 6 m length × 6 nos'],
                        ['Concrete Blocks', '24 blocks × 2.5 Tons = 60 Tons'],
                        ['Beam Self-Weight', '16.6 Tons approx'],
                        ['Total Reaction Load', '≈ 62.766 Tons']
                    ]
                },
                {
                    title: 'Hydraulic Jack Details',
                    headers: ['Parameter', 'Specification'],
                    rows: [
                        ['Capacity', '100 MT'],
                        ['Ram Diameter', '160 mm'],
                        ['Ram Area', '200.96 cm²']
                    ]
                },
                {
                    title: 'DIALGAUGE DETAILS',
                    headers: ['MAKE & MARK', 'RANGE'],
                    rows: [
                        ['Make & Mark Baker/JBE 080', '0-25 mm'],
                        ['Baker / JBD 940', '0-25 mm'],
                        ['Baker / TYPEK08', '0-25 mm'],
                        ['Baker / TYPEK08A', '0-25 mm']
                    ]
                },
                {
                    title: 'PRESSURE GAUGE DETAILS',
                    headers: ['MAKE & MARK', 'RANGE'],
                    rows: [
                        ['PG01-K1192380', '20 KG/ cm²'],
                        ['Ram Dia', '25.4 cm'],
                        ['Ram Area', '506.45 kg/ cm²'],
                        ['Pressure / Division', '20 kg/ div'],
                        ['Load / Division', '10.12 MT/div']
                    ]
                },
                {
                    title: 'LOAD INCREMENT DETAILS',
                    headers: ['INCREMENT', 'DIVISION', 'LOAD IN TON'],
                    rows: [
                        ['1st', '2.5', '25.3 MT'],
                        ['2nd', '5', '50.5 MT'],
                        ['3rd', '7.5', '75.9 MT'],
                        ['4th', '10', '101.2 MT'],
                        ['5th', '12.5', '126.5 MT (SAFE LOAD)'],
                        ['6th', '15', '151.8 MT'],
                        ['7th', '17.5', '177.1 MT'],
                        ['8th', '18.5', '187.22 MT (TEST LOAD)']
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
            },
            addNarrative() {
                this.narratives.push({
                    title: 'New Narrative Section',
                    content: ''
                });
            },
            removeNarrative(index) {
                this.narratives.splice(index, 1);
            }
        }
    }
</script>
@endpush
