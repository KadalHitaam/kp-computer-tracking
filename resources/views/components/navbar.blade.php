<nav id="navbar"
    class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-sm fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            {{-- Logo --}}
            <a href="#beranda" class="flex items-center gap-2.5 group">
                <div
                    class="w-9 h-9 rounded-xl bg-sky-600 flex items-center justify-center shadow-lg shadow-sky-500/20 group-hover:shadow-sky-500/40 transition-shadow duration-300">
                    <i class="ph-bold ph-cpu text-white text-lg"></i>
                </div>
                <span class="text-lg font-bold tracking-tight">
                    <span class="text-sky-600">Tekno</span><span class="text-slate-900">Fix</span>
                </span>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden lg:flex items-center gap-1">
                @foreach ([
                        ['#beranda', 'Beranda'],
                        ['#katalog', 'Katalog'],
                        ['#layanan', 'Layanan'],
                        ['#cek-servis', 'Cek Servis'],
                    ] as [$href, $label])
                    <a href="{{ $href }}"
                        class="nav-link px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-all duration-300">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- CTA + Hamburger --}}
            <div class="flex items-center gap-3">
                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                    class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 transition-colors duration-300">
                    <i class="ph-bold ph-whatsapp-logo text-base"></i>
                    Hubungi WhatsApp
                </a>
                <button id="mobile-menu-btn"
                    class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-all"
                    aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">
                    <i class="ph-bold ph-list text-xl" id="menu-icon"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Overlay --}}
    <div id="mobile-menu"
        class="mobile-menu fixed inset-0 top-16 bg-white/95 backdrop-blur-xl border-t border-slate-200 z-40 lg:hidden"
        role="dialog" aria-label="Mobile navigation">
        <div class="flex flex-col items-center justify-center gap-6 pt-20">
            @foreach ([
                    ['#beranda', 'Beranda'],
                    ['#katalog', 'Katalog'],
                    ['#layanan', 'Layanan'],
                    ['#cek-servis', 'Cek Servis'],
                ] as [$href, $label])
                <a href="{{ $href }}"
                    class="mobile-nav-link text-xl font-semibold text-slate-700 hover:text-sky-600 transition-colors">
                    {{ $label }}
                </a>
            @endforeach
            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                class="mt-4 inline-flex items-center gap-2 px-8 py-3 rounded-full text-base font-semibold text-white bg-sky-500 hover:bg-sky-600 transition-colors duration-300">
                <i class="ph-bold ph-whatsapp-logo"></i>
                Hubungi WhatsApp
            </a>
        </div>
    </div>
</nav>