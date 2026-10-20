<x-layouts.app>
    <section class="min-h-[80vh] flex items-center justify-center py-12 px-4 bg-slate-50">
        
        {{-- Card Login dengan pembatas lebar pasti (Inline Style Fallback) --}}
        <div style="max-width: 420px; width: 100%; margin: 0 auto;" 
             class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-sm">
            
            {{-- Header Card & Logo --}}
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 mb-3 text-sky-600 font-bold text-xl">
                    <i class="ph-bold ph-cpu text-2xl"></i>
                    <span>TeknoFix</span>
                </a>
                <h1 class="text-2xl font-extrabold text-slate-900">Selamat Datang</h1>
                <p class="text-sm text-slate-500 mt-1">Masukkan kredensial akun kamu untuk melanjutkan.</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs flex items-center gap-2">
                    <i class="ph-bold ph-check-circle text-base"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Alamat Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="nama@email.com"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('email') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="ph-bold ph-warning-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700">
                            Kata Sandi
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-sky-600 hover:text-sky-700 transition">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <input type="password" id="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border @error('password') border-rose-500 @else border-slate-300 @enderror text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('password')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="ph-bold ph-warning-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-slate-300 text-sky-500 focus:ring-sky-400">
                        <span class="text-xs text-slate-600">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="w-full py-3.5 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-full shadow-sm shadow-sky-500/20 transition-all duration-200 active:scale-95 flex items-center justify-center gap-2">
                    <span>Masuk Akun</span>
                    <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>

            {{-- Footer Links --}}
            @if (Route::has('register'))
                <div class="mt-8 pt-6 border-t border-slate-100 text-center text-xs text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-sky-600 hover:text-sky-700 transition ml-1">
                        Daftar sekarang
                    </a>
                </div>
            @endif

        </div>
    </section>
</x-layouts.app>