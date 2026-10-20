# Implementation Plan: TeknoFix Landing Page Redesign

## Overview

Refactor `welcome.blade.php` dan komponen Blade terkait dari dark theme generik ke Clean Light Mode dengan estetika Bento Grid, Dual-tone typography, dan Floating Cards. Implementasi dilakukan secara inkremental: mulai dari fondasi CSS/layout, lalu komponen per-komponen, kemudian backend AJAX, dan diakhiri dengan testing.

Stack: Laravel 13 + Blade, Tailwind CSS v4, Phosphor Icons. Tidak ada dependensi baru.

---

## Tasks

- [x] 1. Perbarui layout dasar dan CSS global ke Light Mode
  - [x] 1.1 Update `resources/views/components/layouts/app.blade.php`
    - Ganti class `<body>` dari `bg-slate-950 text-slate-100` menjadi `bg-slate-50 text-slate-900`
    - Tambahkan `<meta name="csrf-token" content="{{ csrf_token() }}">` di dalam `<head>` untuk kebutuhan AJAX
    - Pertahankan font Inter, Phosphor Icons CDN, dan Vite asset loading
    - _Requirements: 1.1, 1.4_

  - [x] 1.2 Update `resources/css/app.css` dengan utility classes Light Mode
    - Ganti/tambah class `.nav-light` → `bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-sm`
    - Ganti/tambah class `.bento-card-light` → `bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow`
    - Tambah class `.btn-cta-light` → `bg-sky-500 hover:bg-sky-600 text-white rounded-full transition-colors`
    - Tambah class `.btn-ghost-light` → `border border-sky-300 text-sky-600 hover:bg-sky-50 rounded-full transition-colors`
    - Hapus atau jadikan opsional `.grid-bg` (dark hero background) dan `.text-glow-cyan`
    - Update custom scrollbar dari dark ke light (`bg-slate-200`)
    - _Requirements: 1.1, 1.2_

- [x] 2. Redesain Navbar ke Light Theme
  - [x] 2.1 Update `resources/views/components/navbar.blade.php`
    - Ganti container class dari `.nav-glass` dark menjadi `.nav-light` (atau inline: `bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-sm`)
    - Update logo teks: aksen dari `text-cyan-400` → `text-sky-600`, teks biasa dari `text-slate-100` → `text-slate-900`
    - Update nav links: dari `text-slate-300 hover:text-cyan-400` → `text-slate-600 hover:text-sky-600`
    - Update tombol CTA menjadi `bg-sky-500 hover:bg-sky-600 text-white rounded-full` dengan teks "Hubungi WhatsApp"
    - Update mobile overlay dari `bg-slate-950/95` → `bg-white/95 border-t border-slate-200`
    - Pastikan semua ID JS dipertahankan: `id="navbar"`, `id="mobile-menu-btn"`, `id="mobile-menu"`, `id="menu-icon"`
    - _Requirements: 5.1, 5.2, 5.4_

  - [x] 2.2 Tulis unit test untuk halaman utama (navbar section)
    - Test GET `/` → HTTP 200
    - Test response contains `Hubungi WhatsApp` (Requirements 5.2)
    - Buat file `tests/Feature/WelcomePageTest.php` dengan `php artisan make:test --phpunit WelcomePageTest`
    - _Requirements: 5.1, 5.2_

- [x] 3. Redesain Hero Section ke Light Theme dengan Split Layout
  - [x] 3.1 Update `resources/views/components/hero.blade.php` — struktur layout
    - Terapkan split layout 2 kolom (`lg:grid-cols-3`) pada layar desktop >= 1024px: kolom kiri `lg:col-span-2` untuk pesan nilai, kolom kanan untuk floating cards
    - Ganti section bg dari `.grid-bg` ke `bg-slate-50` atau `bg-gradient-to-br from-slate-50 to-sky-50/30`
    - Ganti dekoratif blobs dari `bg-cyan-500/5` ke `bg-sky-200/40`
    - _Requirements: 2.1_

  - [x] 3.2 Update `resources/views/components/hero.blade.php` — konten kolom kiri
    - Tambah/update pill tag badge "Terpercaya Sejak 2018" dengan class `bg-sky-50 border border-sky-200 text-sky-700` dan indikator titik pulse `bg-emerald-500`
    - Update H1 Dual-tone: kata utama `text-slate-900 font-bold`, kata aksen `text-sky-600` (atau `bg-gradient-to-r from-sky-500 to-teal-600 bg-clip-text text-transparent`)
    - Update CTA primary dari `.btn-cta-glow` → `btn-cta-light` (`bg-sky-500 hover:bg-sky-600 text-white rounded-full`)
    - Update teks statistik dari `text-cyan-400` → `text-sky-600`
    - Pastikan ID anchor `id="beranda"` dan `id="cek-servis"` dipertahankan
    - _Requirements: 2.1, 2.2, 1.3, 1.4_

  - [x] 3.3 Update `resources/views/components/hero.blade.php` — Resi Widget (kolom kanan)
    - Update kartu resi widget: dari dark background → `bg-white border border-slate-200/80 rounded-3xl shadow-sm`
    - Update input resi: dari `bg-slate-800/80 border-slate-700` → `bg-slate-50 border-slate-300 text-slate-900 placeholder-slate-400`
    - Update tombol "Lacak": `bg-sky-500 hover:bg-sky-600 text-white rounded-full`
    - Tambah area output `id="resi-result"` dengan atribut `aria-live="polite"` untuk aksesibilitas
    - Pertahankan semua ID JS: `id="input-resi"`, `id="btn-cek-resi"`, `id="resi-result"`
    - _Requirements: 2.1, 2.3, 2.4, 2.5_

- [x] 4. Buat Komponen Social Proof Bar
  - [x] 4.1 Buat `resources/views/components/social-proof-bar.blade.php`
    - Buat section dengan `py-10 border-y border-slate-200/80 bg-white`
    - Tambah label `<p>` kecil: "Melayani Semua Brand Laptop Populer" dengan `text-xs text-slate-400 uppercase tracking-widest`
    - Tampilkan 6 brand (ASUS, Lenovo, Acer, HP, MSI, Dell) menggunakan teks nama bold monokrom: `text-slate-400 hover:text-slate-600 font-bold tracking-widest text-lg transition-colors`
    - Layout desktop: `flex flex-wrap justify-center items-center gap-8 md:gap-12`
    - Layout mobile (< 768px): `grid grid-cols-3` yang rapi
    - _Requirements: 3.1, 3.2, 3.3_

  - [x] 4.2 Inject komponen ke `resources/views/welcome.blade.php`
    - Tambahkan `<x-social-proof-bar />` tepat di antara `<x-hero />` dan `<x-services />`
    - _Requirements: 3.1_

  - [x] 4.3 Tulis unit test untuk Social Proof Bar
    - Tambahkan ke `WelcomePageTest`: assert response contains `ASUS`, `Lenovo`, `Acer`, `HP`, `MSI`
    - Assert Social Proof Bar ada di DOM setelah hero section
    - _Requirements: 3.2_

- [~] 5. Checkpoint — Verifikasi tampilan dan struktur halaman
  - Pastikan semua test yang ada lulus, jalankan `php artisan test --compact`
  - Tanya user jika ada pertanyaan sebelum melanjutkan ke redesain services

- [x] 6. Redesain Services Section ke Bento Grid Light Theme
  - [x] 6.1 Update `resources/views/components/services.blade.php` — Bento Grid layout
    - Terapkan Bento Grid dengan variasi ukuran kartu (besar, sedang, kecil) menggunakan `grid` + `col-span` / `row-span`
    - Update semua `.bento-card` dark → `bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow`
    - Update section badge: dari `bg-blue-500/10 text-blue-400` → `bg-teal-50 border border-teal-200 text-teal-700`
    - Update H2 aksen gradient: dari `from-cyan-400 to-blue-400` → `from-sky-500 to-teal-600`
    - Update service tag pills: dari `bg-slate-800/80 border-slate-700` → `bg-slate-100 border-slate-200 text-slate-700`
    - _Requirements: 4.1, 4.3_

  - [x] 6.2 Tambahkan stat cards ke Services Section
    - Buat tiga kartu statistik di baris atas bento grid:
      - "5.200+ Unit Diperbaiki" (`text-4xl lg:text-5xl font-extrabold text-sky-600`)
      - "98% Kepuasan" (styling sama)
      - "Garansi 6 Bulan" (styling sama)
    - Kartu menggunakan `bg-white rounded-3xl border border-slate-200/80 shadow-sm`
    - _Requirements: 4.2_

  - [x] 6.3 Tulis unit test untuk Services Section
    - Tambahkan ke `WelcomePageTest`: assert response contains `5.200+`, `98%`, `Garansi 6 Bulan`
    - Assert kartu layanan utama (Servis, Upgrade, Penjualan) hadir dalam response
    - _Requirements: 4.2, 4.3_

- [x] 7. Redesain How It Works Section ke Light Theme
  - [x] 7.1 Update `resources/views/components/how-it-works.blade.php`
    - Update garis dekorasi: dari `via-cyan-500/20` → `via-sky-300/40`
    - Update `.bento-card` dark → `bg-white rounded-3xl border border-slate-200/80 shadow-sm` (light)
    - Update badge: dari `bg-cyan-500/10 text-cyan-400` → `bg-sky-50 border border-sky-200 text-sky-700`
    - Update step number circles: dari `bg-cyan-400/20` → `bg-sky-100 border border-sky-300 text-sky-700`
    - Update step icon boxes: dari `bg-cyan-400/10` → `bg-sky-50`
    - Update icon colors: dari `text-cyan-400` → `text-sky-600`, dari `text-emerald-400` → `text-emerald-600`
    - Update connector line: dari `from-cyan-500/10` → `from-sky-300/30`
    - _Requirements: 1.1, 1.2, 1.4_

- [x] 8. Redesain Footer ke Light/Dark Lembut
  - [x] 8.1 Update `resources/views/components/site-footer.blade.php`
    - Set footer background ke `bg-slate-900` (dark lembut untuk visual closure)
    - Update border top ke `border-slate-700`
    - Update logo aksen: dari `text-cyan-400` → `text-sky-400`
    - Update link hover: dari `hover:text-cyan-400` → `hover:text-sky-400`
    - Pertahankan copyright dinamis `{{ date('Y') }}` dan teks alamat toko
    - _Requirements: 5.3_

  - [x] 8.2 Tulis unit test untuk Footer
    - Tambahkan ke `WelcomePageTest`: assert response contains `{{ date('Y') }}` (atau nilai tahun saat ini)
    - Assert response contains teks alamat toko
    - _Requirements: 5.3_

- [~] 9. Checkpoint — Verifikasi semua komponen visual
  - Jalankan `php artisan test --compact tests/Feature/WelcomePageTest.php`
  - Pastikan semua section hadir dalam DOM GET `/` secara berurutan: hero → social-proof-bar → services → how-it-works → footer
  - Tanya user jika ada pertanyaan sebelum implementasi backend

- [x] 10. Implementasi Backend: ResiController & Route AJAX
  - [x] 10.1 Buat `app/Http/Controllers/ResiController.php`
    - Jalankan `php artisan make:controller ResiController --no-interaction`
    - Implementasikan method `track(Request $request): JsonResponse`
    - Tambahkan validasi: `'resi' => ['required', 'string', 'regex:/^SRV-\d{4}$/']`
    - Query `ServiceOrder::where('resi', $validated['resi'])->first()`
    - Jika tidak ditemukan: return `response()->json(['found' => false, 'message' => '...'], 404)`
    - Jika ditemukan: return `response()->json(['found' => true, 'resi' => ..., 'status' => ..., 'estimasi' => ...], 200)`
    - Jika model `ServiceOrder` belum ada, return dummy data statis untuk resi valid agar fitur visual berfungsi
    - _Requirements: 2.4, 2.5_

  - [x] 10.2 Daftarkan route POST di `routes/web.php`
    - Tambahkan `Route::post('/resi/track', [ResiController::class, 'track'])->name('resi.track');`
    - Import `App\Http\Controllers\ResiController` di bagian atas file
    - _Requirements: 2.4_

  - [x] 10.3 Tulis property test untuk valid resi format (Property 1)
    - Buat `tests/Feature/ResiControllerTest.php` dengan `php artisan make:test --phpunit ResiControllerTest`
    - **Property 1: Resi valid mengembalikan respons JSON terstruktur**
    - **Validates: Requirements 2.4**
    - Implementasikan `#[DataProvider('validResiProvider')]` yang men-generate `SRV-0000` hingga `SRV-9999` (step 100 = 100 samples)
    - Assert setiap request mengembalikan HTTP 200 atau 404 (bukan 422)
    - Assert response body mengandung kunci `found`
    - _Requirements: 2.4_

  - [x] 10.4 Tulis property test untuk invalid resi format (Property 2)
    - **Property 2: Input resi invalid selalu ditolak dengan error validasi**
    - **Validates: Requirements 2.5**
    - Implementasikan `#[DataProvider('invalidResiProvider')]` dengan dataset: `''`, `'SRV-'`, `'SRV-12'`, `'SRV-12345'`, `'SRV-ABCD'`, `'1234'`, `'srv-1234'`, `'SRV 1234'` dan tambahan generated invalid strings
    - Assert setiap request mengembalikan HTTP 422
    - Assert response body mengandung kunci `errors`
    - _Requirements: 2.5_

  - [x] 10.5 Tulis unit tests individual untuk ResiController
    - `test_valid_resi_format_returns_json_response` — POST `SRV-1234` → HTTP 200 atau 404, JSON has `found` key
    - `test_empty_resi_returns_validation_error` — POST `""` → HTTP 422
    - `test_invalid_format_without_prefix_returns_validation_error` — POST `"1234"` → HTTP 422
    - `test_invalid_format_with_letters_after_prefix_returns_validation_error` — POST `"SRV-ABCD"` → HTTP 422
    - `test_valid_resi_not_in_database_returns_not_found` — POST `SRV-9999` (tidak ada di DB) → HTTP 404, `found == false`
    - _Requirements: 2.4, 2.5_

- [x] 11. Implementasi AJAX Resi Tracker di Frontend
  - [x] 11.1 Update `resources/js/app.js` dengan logika AJAX resi tracker
    - Tambahkan event listener `DOMContentLoaded` untuk menginisialisasi tracker
    - Implementasikan fungsi `handleCekResi()` dengan logika:
      - Guard: jika input kosong atau tidak diawali `SRV-`, tampilkan warning langsung tanpa request
      - Loading state: disable tombol, tampilkan "Mencari data servis..." di `#resi-result`
      - Fetch POST ke `/resi/track` dengan header `Content-Type: application/json` dan `X-CSRF-TOKEN` dari meta tag
      - Handle HTTP 422 → tampilkan pesan error validasi
      - Handle HTTP 404 atau `found == false` → tampilkan "Resi tidak ditemukan"
      - Handle sukses → render data resi (nomor, status, estimasi)
      - Catch network error → tampilkan "Terjadi kesalahan jaringan. Coba lagi."
      - Finally: re-enable tombol
    - Implementasikan fungsi `showResiResult(state, data)` yang merender state: `loading`, `success`, `not-found`, `warning`, `error`
    - _Requirements: 2.4, 2.5_

  - [x] 11.2 Update `resources/js/app.js` — navbar scroll effect dan hamburger menu
    - Pastikan scroll shadow effect pada `id="navbar"` tetap berfungsi di light theme
    - Pastikan hamburger toggle `id="mobile-menu-btn"` membuka/menutup `id="mobile-menu"`
    - Update ikon toggle antara `ph-list` dan `ph-x` via `id="menu-icon"`
    - _Requirements: 5.4_

- [x] 12. Checkpoint Final — Jalankan semua test dan verifikasi
  - Jalankan `php artisan test --compact` untuk semua test
  - Jalankan `vendor/bin/pint --dirty --format agent` untuk memastikan formatting PHP konsisten
  - Pastikan semua test lulus, tanya user jika ada pertanyaan

---

## Notes

- Tasks bertanda `*` bersifat opsional dan dapat dilewati untuk MVP yang lebih cepat
- Setiap task mereferensikan requirements spesifik untuk traceability
- Checkpoint memastikan validasi inkremental setelah setiap kelompok perubahan besar
- Property tests (10.3 & 10.4) memvalidasi properti universal: valid resi selalu non-422, invalid resi selalu 422
- Unit tests individual (10.5) memvalidasi contoh spesifik dan edge cases
- Property 3 (copyright tahun) divalidasi lewat unit test di WelcomePageTest (8.2) karena bersifat rendering
- Footer menggunakan `bg-slate-900` (dark) untuk visual closure — ini disengaja sesuai desain
- Jika `ServiceOrder` model belum ada, `ResiController` mengembalikan dummy data agar fitur visual tetap berjalan

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1.1", "1.2"] },
    { "id": 1, "tasks": ["2.1", "3.1", "4.1", "7.1", "8.1"] },
    { "id": 2, "tasks": ["3.2", "4.2", "6.1", "10.1", "10.2"] },
    { "id": 3, "tasks": ["3.3", "4.3", "6.2", "11.1", "11.2"] },
    { "id": 4, "tasks": ["2.2", "6.3", "8.2", "10.3", "10.4", "10.5"] }
  ]
}
```
