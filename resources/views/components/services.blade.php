<section id="layanan" class="relative py-20 lg:py-28">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-16 reveal">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-50 border border-teal-200 text-teal-700 text-xs font-semibold tracking-wider uppercase mb-4">
                <i class="ph-bold ph-wrench"></i>
                Layanan Kami
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">
                Semua Kebutuhan
                <span class="text-sky-600">
                    Komputer Anda
                </span>
            </h2>
            <p class="text-slate-500 mt-4 max-w-2xl mx-auto text-base sm:text-lg">
                Dari perbaikan hardware hingga pengadaan laptop baru, kami siap melayani dengan standar kualitas
                tertinggi.
            </p>
        </div>

        {{-- Bento Grid --}}
        <div id="katalog" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5">

            {{-- Row 1: Stat Cards (3 small cards) --}}

            {{-- Stat Card 1: 5.200+ Unit Diperbaiki --}}
            <div
                class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 flex flex-col justify-center reveal">
                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center mb-4">
                    <i class="ph-bold ph-wrench text-lg text-sky-600"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-extrabold text-sky-600">5.200+</p>
                <p class="text-sm text-slate-500 mt-2">Unit Diperbaiki</p>
            </div>

            {{-- Stat Card 2: 98% Kepuasan --}}
            <div
                class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 flex flex-col justify-center reveal">
                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center mb-4">
                    <i class="ph-bold ph-smiley text-lg text-sky-600"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-extrabold text-sky-600">98%</p>
                <p class="text-sm text-slate-500 mt-2">Kepuasan Pelanggan</p>
            </div>

            {{-- Stat Card 3: Garansi 6 Bulan --}}
            <div
                class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 flex flex-col justify-center reveal">
                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center mb-4">
                    <i class="ph-bold ph-shield-check text-lg text-sky-600"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-extrabold text-sky-600">6 Bulan</p>
                <p class="text-sm text-slate-500 mt-2">Garansi Servis</p>
            </div>

            {{-- Card 1: Servis & Upgrade (wide — lg:col-span-2) --}}
            <div
                class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow lg:col-span-2 p-8 sm:p-10 group reveal">
                <div class="flex flex-col sm:flex-row sm:items-start gap-6">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-sky-100 to-sky-50 border border-sky-200 flex items-center justify-center flex-shrink-0 group-hover:shadow-lg group-hover:shadow-sky-200/60 transition-all duration-500">
                        <i class="ph-bold ph-wrench text-2xl text-sky-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-3">Jasa Servis &amp; Upgrade</h3>
                        <p class="text-slate-500 mb-5 leading-relaxed">
                            Perbaikan profesional untuk segala jenis kerusakan laptop dan PC.
                            Teknisi bersertifikat dengan pengalaman 8+ tahun menangani ribuan kasus.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ([
                                    ['ph-lightning', 'Mati Total'],
                                    ['ph-cpu', 'Reball IC'],
                                    ['ph-hard-drives', 'Upgrade SSD'],
                                    ['ph-drop', 'Water Damage'],
                                    ['ph-monitor', 'Ganti LCD'],
                                ] as [$icon, $label])
                                <span
                                    class="px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-xs font-medium text-slate-700">
                                    <i class="ph {{ $icon }} text-sky-500 mr-1"></i>{{ $label }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Katalog Laptop --}}
            <div
                class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow p-8 group reveal">
                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 border border-blue-200 flex items-center justify-center mb-5 group-hover:shadow-lg group-hover:shadow-blue-200/60 transition-all duration-500">
                    <i class="ph-bold ph-laptop text-2xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Katalog Laptop Baru &amp; Second</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Pilihan laptop terkurasi untuk segala kebutuhan — gaming, desain, bisnis, hingga pelajar.
                    Semua sudah melalui quality check ketat.
                </p>
                <div class="space-y-3">
                    @foreach ([
                            ['ph-game-controller', 'Gaming & High-Performance'],
                            ['ph-briefcase', 'Bisnis & Produktivitas'],
                            ['ph-student', 'Budget-Friendly Pelajar'],
                        ] as [$icon, $label])
                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <i class="ph {{ $icon }} text-blue-500 text-sm"></i>
                            </div>
                            <span class="text-slate-700">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Card 3: Sparepart (full width — lg:col-span-3) --}}
            <div
                class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow lg:col-span-3 p-8 group reveal">
                <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-10">
                    <div class="flex items-center gap-5 flex-shrink-0">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 border border-emerald-200 flex items-center justify-center group-hover:shadow-lg group-hover:shadow-emerald-200/60 transition-all duration-500">
                            <i class="ph-bold ph-package text-2xl text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Pusat Sparepart Original</h3>
                            <p class="text-slate-500 text-sm mt-1">Jaminan keaslian dengan garansi distributor resmi.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3 md:ml-auto">
                        @foreach ([
                                ['ph-battery-charging', 'Baterai'],
                                ['ph-keyboard', 'Keyboard'],
                                ['ph-monitor', 'LCD Panel'],
                                ['ph-memory', 'RAM & SSD'],
                                ['ph-plug', 'Charger'],
                            ] as [$icon, $label])
                            <div
                                class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 border border-slate-200 text-slate-700">
                                <i class="ph {{ $icon }} text-emerald-600"></i>
                                <span class="text-sm">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>