<section id="alur-servis" class="relative py-20 lg:py-28 overflow-hidden">

    {{-- Decorative top/bottom lines --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-sky-300/40 to-transparent">
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-20 reveal">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 border border-sky-200 text-sky-700 text-xs font-semibold tracking-wider uppercase mb-4">
                <i class="ph-bold ph-path"></i>
                Alur Servis
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">
                Mudah &amp;
                <span class="text-sky-600">
                    Transparan
                </span>
            </h2>
            <p class="text-slate-500 mt-4 max-w-xl mx-auto text-base sm:text-lg">
                Empat langkah sederhana menuju perangkat Anda kembali prima.
            </p>
        </div>

        {{-- Steps --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-4">

            @php
                $steps = [
                    [
                        'number' => '01',
                        'color' => 'cyan',
                        'icon' => 'ph-chat-teardrop-dots',
                        'title' => 'Konsultasi & Drop-off',
                        'desc' => 'Konsultasikan keluhan perangkat Anda secara gratis via WhatsApp atau datang langsung ke toko.',
                    ],
                    [
                        'number' => '02',
                        'color' => 'cyan',
                        'icon' => 'ph-microscope',
                        'title' => 'Diagnosa Transparan',
                        'desc' => 'Tim kami melakukan pengecekan menyeluruh dan memberikan laporan detail beserta estimasi biaya.',
                    ],
                    [
                        'number' => '03',
                        'color' => 'cyan',
                        'icon' => 'ph-gear-fine',
                        'title' => 'Eksekusi & Tracking',
                        'desc' => 'Setelah disetujui, perbaikan dimulai. Pantau progress real-time dengan nomor resi servis Anda.',
                    ],
                    [
                        'number' => '04',
                        'color' => 'emerald',
                        'icon' => 'ph-seal-check',
                        'title' => 'Selesai & Garansi',
                        'desc' => 'Perangkat kembali prima! Dilindungi garansi servis hingga 6 bulan untuk ketenangan Anda.',
                    ],
                ];
            @endphp

            @foreach ($steps as $index => $step)
                <div class="reveal" @if($index > 0) style="transition-delay: {{ $index * 0.1 }}s" @endif>
                    <div
                        class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-7 h-full text-center lg:text-left">
                        @if ($step['color'] === 'emerald')
                            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full
                                                bg-emerald-100 border border-emerald-300 mb-5">
                                <span class="text-sm font-bold text-emerald-700">{{ $step['number'] }}</span>
                            </div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-50 flex items-center justify-center mb-4 mx-auto lg:mx-0">
                                <i class="ph-bold {{ $step['icon'] }} text-2xl text-emerald-600"></i>
                            </div>
                        @else
                            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full
                                                bg-sky-100 border border-sky-300 mb-5">
                                <span class="text-sm font-bold text-sky-700">{{ $step['number'] }}</span>
                            </div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-50 flex items-center justify-center mb-4 mx-auto lg:mx-0">
                                <i class="ph-bold {{ $step['icon'] }} text-2xl text-sky-600"></i>
                            </div>
                        @endif
                        <h4 class="text-base font-bold text-slate-900 mb-2">{{ $step['title'] }}</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Desktop connector line --}}
        <div class="hidden lg:block absolute top-[calc(50%+40px)] left-[15%] right-[15%] h-px z-0">
            <div class="w-full h-full bg-gradient-to-r from-sky-300/30 via-sky-300/40 to-emerald-500/10"></div>
        </div>

    </div>
</section>