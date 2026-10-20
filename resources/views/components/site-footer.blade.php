<footer class="relative pt-16 pb-8 bg-slate-900 border-t border-slate-700">

    {{-- Decorative blob --}}
    <div class="absolute top-0 left-1/4 w-64 h-64 bg-cyan-500/[0.03] rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-12">

            {{-- Brand --}}
            <div>
                <a href="#beranda" class="flex items-center gap-2.5 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center">
                        <i class="ph-bold ph-cpu text-white text-lg"></i>
                    </div>
                    <span class="text-lg font-bold tracking-tight">
                        <span class="text-sky-400">Tekno</span><span class="text-slate-100">Fix</span>
                    </span>
                </a>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                    Solusi terpercaya untuk pembelian, perbaikan, dan upgrade laptop &amp; komputer di Indonesia.
                </p>
            </div>

            {{-- Address & Hours --}}
            <div>
                <h4 class="text-sm font-semibold text-slate-200 uppercase tracking-wider mb-4">
                    Lokasi &amp; Jam Operasional
                </h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 text-sm text-slate-400">
                        <i class="ph-bold ph-map-pin text-sky-400 mt-0.5 flex-shrink-0"></i>
                        <span>Jl. Teknologi No. 123, Kelurahan Digital, Jakarta Selatan 12345</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm text-slate-400">
                        <i class="ph-bold ph-clock text-sky-400 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p>Senin – Sabtu: 09.00 – 18.00 WIB</p>
                            <p>Minggu: Tutup</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 text-sm text-slate-400">
                        <i class="ph-bold ph-phone text-sky-400 mt-0.5 flex-shrink-0"></i>
                        <span>(021) 1234-5678</span>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-sm font-semibold text-slate-200 uppercase tracking-wider mb-4">Navigasi</h4>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ([
                        ['#beranda',     'Beranda'],
                        ['#katalog',     'Katalog'],
                        ['#layanan',     'Layanan'],
                        ['#cek-servis',  'Cek Servis'],
                        ['#alur-servis', 'Alur Servis'],
                    ] as [$href, $label])
                        <a href="{{ $href }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors duration-300">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent mb-6"></div>

        {{-- Copyright --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} TeknoFix. All rights reserved.</p>
            <p>Dibuat dengan <i class="ph-fill ph-heart text-sky-400"></i> di Jakarta</p>
        </div>
    </div>
</footer>
