<section id="beranda"
    class="relative min-h-screen pt-28 pb-16 lg:pt-36 lg:pb-24 bg-gradient-to-br from-slate-50 to-sky-50/30">

    {{-- Background decorative blobs --}}
    <div
        class="absolute top-20 left-0 w-96 h-96 bg-sky-200/40 rounded-full blur-3xl pointer-events-none animate-[glow-pulse_3s_ease-in-out_infinite]">
    </div>
    <div
        class="absolute bottom-20 right-0 w-80 h-80 bg-sky-200/40 rounded-full blur-3xl pointer-events-none animate-[glow-pulse_3s_ease-in-out_infinite] [animation-delay:1.5s]">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-5">

            {{-- Hero Main Card --}}
            <div
                class="bg-white border border-slate-200/80 rounded-3xl shadow-sm lg:col-span-2 lg:row-span-2 p-8 sm:p-10 lg:p-12 flex flex-col justify-center relative opacity-0 animate-[slide-up_0.8s_ease-out_forwards]">
                {{-- Radial glow orbs --}}
                <div class="hero-glow -top-20 -left-20 animate-[glow-pulse_3s_ease-in-out_infinite]"></div>
                <div class="hero-glow bottom-10 right-10 animate-[glow-pulse_3s_ease-in-out_infinite] [animation-delay:1.5s]"
                    style="background: radial-gradient(circle, rgba(149, 219, 243, 1) 0%, transparent 70%)"></div>

                <div class="relative z-10">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 border border-sky-200 text-sky-700 text-xs font-semibold tracking-wider uppercase mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Terpercaya Sejak 2018
                    </div>

                    <h1
                        class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-extrabold leading-tight tracking-tight mb-6 text-slate-900">
                        Solusi Presisi untuk
                        <span class="text-sky-600">
                            Pembelian &amp; Perbaikan
                        </span>
                        Laptop
                    </h1>

                    <p class="text-slate-500 text-base sm:text-lg max-w-xl mb-8 leading-relaxed">
                        Dapatkan laptop impian Anda atau perbaiki perangkat dengan teknisi bersertifikat.
                        Diagnosa transparan, harga jujur, garansi resmi hingga 6 bulan.
                    </p>

                    <div class="flex flex-wrap gap-3 sm:gap-4">
                        <a href="#katalog"
                            class="btn-cta-light inline-flex items-center gap-2 px-6 py-3 sm:px-8 sm:py-3.5 text-sm sm:text-base font-semibold">
                            <i class="ph-bold ph-storefront"></i>
                            Lihat Katalog
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                            class="btn-ghost-light inline-flex items-center gap-2 px-6 py-3 sm:px-8 sm:py-3.5 text-sm sm:text-base font-semibold">
                            <i class="ph-bold ph-chat-circle-dots"></i>
                            Konsultasi
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="flex flex-wrap gap-8 mt-10 pt-8 border-t border-slate-200/80">
                        @foreach ([
                                ['5,200+', 'Unit Terservis'],
                                ['98%', 'Tingkat Kepuasan'],
                                ['6 Bln', 'Garansi Servis'],
                            ] as [$value, $label])
                            <div>
                                <div class="text-2xl sm:text-3xl font-bold text-sky-600">{{ $value }}</div>
                                <div class="text-xs text-slate-500 mt-1 uppercase tracking-wider">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Track Service Card --}}
            <div id="cek-servis"
                class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-7 flex flex-col justify-between opacity-0 animate-[slide-up_0.8s_ease-out_0.15s_forwards]">
                <div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-sky-50 border border-sky-200 flex items-center justify-center mb-5">
                        <i class="ph-bold ph-magnifying-glass text-sky-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Lacak Servis</h3>
                    <p class="text-sm text-slate-500 mb-5">
                        Masukkan nomor resi untuk cek progress perbaikan Anda secara real-time.
                    </p>
                </div>
                <div>
                    <div class="flex gap-2">
                        <input type="text" id="input-resi" placeholder="Contoh: SRV-1234"
                            class="flex-1 px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-400 transition-all duration-300"
                            aria-label="Nomor resi servis">
                        <button id="btn-cek-resi"
                            class="px-4 py-2.5 rounded-full bg-sky-500 hover:bg-sky-600 text-sm font-semibold text-white transition-all duration-300 active:scale-95"
                            aria-label="Cek status resi">
                            <i class="ph-bold ph-arrow-right"></i>
                        </button>
                    </div>
                    <div id="resi-result" class="mt-3 hidden" aria-live="polite"></div>
                </div>
            </div>

            {{-- Visual / Decorative Card --}}
            <div
                class="bg-gradient-to-br from-sky-100 to-teal-50 border border-sky-200/80 rounded-3xl shadow-sm p-0 overflow-hidden relative group opacity-0 animate-[slide-up_0.8s_ease-out_0.3s_forwards]">

                <div class="absolute inset-0 flex items-center justify-center z-10">
                    <div class="relative animate-[float_6s_ease-in-out_infinite]">
                        <div
                            class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl bg-white/70 border border-sky-200 flex items-center justify-center shadow-lg shadow-sky-200/40">
                            <i class="ph-thin ph-laptop text-5xl sm:text-6xl text-sky-500"></i>
                        </div>
                        <div
                            class="absolute -top-3 -right-3 w-6 h-6 rounded-full bg-sky-200 border border-sky-300 flex items-center justify-center">
                            <div class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></div>
                        </div>
                        <div
                            class="absolute -bottom-2 -left-2 w-5 h-5 rounded-full bg-teal-200 border border-teal-300 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse [animation-delay:0.8s]">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-4 left-5 right-5 z-20">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="ph-bold ph-shield-check text-sky-600"></i>
                        <span>Sparepart Original • Garansi Resmi</span>
                    </div>
                </div>

                <div class="w-full h-full min-h-[220px] sm:min-h-[260px]"></div>
            </div>

        </div>
    </div>
</section>