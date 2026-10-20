# Design Document — TeknoFix Landing Page Redesign

## Overview

Dokumen ini menjabarkan desain teknis untuk me-refactor halaman utama TeknoFix (`welcome.blade.php`) dari *dark theme* generik ke **Clean Light Mode** modern. Redesign mengadopsi estetika *Bento Grid*, *Dual-tone typography*, dan *Floating Cards* mengikuti standar visual SaaS/Fintech kontemporer.

Stack yang dipertahankan: **Laravel 13 + Blade**, **Tailwind CSS v4**, **Phosphor Icons**. Tidak ada dependensi baru yang ditambahkan. Seluruh perubahan bersifat front-end (Blade + CSS + JavaScript) plus satu endpoint AJAX ringan untuk fitur lacak resi.

### Design Goals

1. Ganti tema gelap ke Light Mode bersih — latar `bg-slate-50`, kartu `bg-white`, teks `text-slate-900`.
2. Terapkan visual Bento Grid dengan `rounded-3xl`, `border border-slate-200/80`, `shadow-sm hover:shadow-md`.
3. Tambahkan Social Proof Bar (logo brand) antara Hero dan Services.
4. Buat endpoint AJAX `/resi/track` untuk pelacakan nomor servis secara real-time.
5. Hamburger menu mobile tetap fungsional dan responsif.

---

## Architecture

Arsitektur tetap mengikuti pola Blade component yang sudah ada. Tidak ada perubahan pada lapisan routing utama kecuali penambahan satu route AJAX.

```
routes/web.php
├── GET  /              → welcome.blade.php (no change)
└── POST /resi/track    → ResiController@track (NEW)

app/Http/Controllers/
└── ResiController.php  (NEW)

resources/views/
├── welcome.blade.php                   (updated — tambah social-proof-bar)
└── components/
    ├── layouts/app.blade.php           (updated — body bg, meta CSRF)
    ├── navbar.blade.php                (updated — light theme)
    ├── hero.blade.php                  (updated — light theme, split layout)
    ├── social-proof-bar.blade.php      (NEW)
    ├── services.blade.php              (updated — light theme bento)
    ├── how-it-works.blade.php          (updated — light theme)
    └── site-footer.blade.php           (updated — light theme)

resources/css/app.css                   (updated — light mode utilities)
resources/js/app.js                     (updated — AJAX resi tracker)
```

### Data Flow: Resi Tracking AJAX

```
[Browser]
  │  GET /                 → Halaman welcome.blade.php
  │  User types resi → klik "Lacak"
  │  POST /resi/track  { resi: "SRV-1234", _token: "..." }
  ▼
[ResiController@track]
  │  Validate: required | regex:/^SRV-\d{4}$/
  │  Query: ServiceOrder::where('resi', $resi)->first()
  │  Return: JSON { found: bool, resi, status, estimasi }
  ▼
[Browser]
  │  Render hasil di #resi-result (aria-live="polite")
```

---

## Components and Interfaces

### 1. `layouts/app.blade.php`

**Perubahan:**
- `<body>` class: `bg-slate-950 text-slate-100` → `bg-slate-50 text-slate-900`
- Tambah `<meta name="csrf-token" content="{{ csrf_token() }}">` untuk AJAX
- Pertahankan font Inter, Phosphor Icons CDN, Vite asset loading

### 2. `navbar.blade.php`

**Perubahan dari dark ke light:**
- Container: `nav-glass` (dark) → `bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-sm`
- Logo teks: `text-cyan-400` / `text-slate-100` → `text-sky-600` / `text-slate-900`
- Nav links: `text-slate-300 hover:text-cyan-400` → `text-slate-600 hover:text-sky-600`
- CTA button: gradient dark → `bg-sky-500 hover:bg-sky-600 text-white rounded-full`
- Mobile overlay: `bg-slate-950/95` → `bg-white/95 border-t border-slate-200`

**Interface HTML IDs (dipertahankan untuk JS):**
- `id="navbar"` — scroll shadow effect
- `id="mobile-menu-btn"` — hamburger toggle
- `id="mobile-menu"` — slide-in panel
- `id="menu-icon"` — ikon berganti ph-list ↔ ph-x

### 3. `hero.blade.php`

**Struktur split layout (2 kolom pada lg):**

```
┌─────────────────────────────┬──────────────────┐
│  Kolom Kiri (lg:col-span-2) │  Kolom Kanan     │
│  - Badge "Terpercaya..."    │  - Resi Widget   │
│  - H1 Dual-tone             │    (floating     │
│  - Subtitle                 │     card)        │
│  - CTA buttons              │                  │
│  - Stat bar (3 angka)       ├──────────────────┤
│                             │  Decorative Card │
│                             │  (laptop icon    │
│                             │   floating anim) │
└─────────────────────────────┴──────────────────┘
```

**Perubahan dari dark ke light:**
- Section bg: `grid-bg` (dark lines) → `bg-slate-50` atau gradient subtle `bg-gradient-to-br from-slate-50 to-sky-50/30`
- Decorative blobs: `bg-cyan-500/5` (dark) → `bg-sky-200/40` (light pastel)
- Main card: `.bento-card` dark → `bg-white rounded-3xl border border-slate-200/80 shadow-sm`
- Badge: `bg-cyan-400/10 border-cyan-400/20 text-cyan-400` → `bg-sky-50 border-sky-200 text-sky-700`
- Pulse dot: `bg-cyan-400` → `bg-emerald-500`
- H1 Dual-tone: teks biasa `text-slate-900`, aksen `text-sky-600` (atau gradient `from-sky-500 to-teal-600`)
- CTA primary: `btn-cta-glow` → `bg-sky-500 hover:bg-sky-600 text-white rounded-full`
- Stats: `text-cyan-400` → `text-sky-600`
- Resi widget card: dark background → `bg-white border border-slate-200/80 rounded-3xl shadow-sm`
- Input resi: `bg-slate-800/80 border-slate-700` → `bg-slate-50 border-slate-300 text-slate-900`
- Tombol Lacak: rounded-full, `bg-sky-500`

**HTML IDs (dipertahankan):**
- `id="beranda"` — section anchor
- `id="cek-servis"` — anchor untuk navbar link
- `id="input-resi"` — JS input target
- `id="btn-cek-resi"` — JS click target
- `id="resi-result"` — JS output target (aria-live="polite")

### 4. `social-proof-bar.blade.php` *(BARU)*

Komponen baru yang diinjeksi antara `<x-hero />` dan `<x-services />` di `welcome.blade.php`.

**Struktur:**
```html
<section class="py-10 border-y border-slate-200/80 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <p class="text-center text-xs text-slate-400 uppercase tracking-widest mb-6">
      Melayani Semua Brand Laptop Populer
    </p>
    <!-- Desktop: flex row | Mobile: grid-cols-3 -->
    <div class="flex flex-wrap justify-center items-center gap-8
                md:gap-12 grid grid-cols-3 md:flex">
      <!-- 6 brand items: ASUS, Lenovo, Acer, HP, MSI, Dell -->
      <!-- Setiap item: ikon/SVG + teks nama brand -->
      <!-- Warna: text-slate-400 hover:text-slate-600 transition -->
    </div>
  </div>
</section>
```

Karena Phosphor Icons tidak menyediakan logo brand, brand ditampilkan menggunakan **teks nama bold** dengan styling monokrom (`text-slate-400`, `font-bold`, `tracking-widest`, `text-lg`) dalam container pill yang konsisten. Alternatif: inline SVG sederhana per brand.

### 5. `services.blade.php`

**Perubahan dari dark ke light:**
- Section bg: transparan (inherits `bg-slate-50`)
- `.bento-card` dark → `bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md`
- Section badge: `bg-blue-500/10 text-blue-400` → `bg-teal-50 border-teal-200 text-teal-700`
- H2 aksen: `from-cyan-400 to-blue-400` → `from-sky-500 to-teal-600`
- Service tag pills: `bg-slate-800/80 border-slate-700` → `bg-slate-100 border-slate-200 text-slate-700`
- Stat cards (3 angka besar): ditambahkan sebagai kartu terpisah dalam grid dengan `text-4xl lg:text-5xl font-extrabold text-sky-600`

**Stat cards (baru):** Tiga kartu kecil di baris paling atas bento grid:
```
┌──────────────┬──────────────┬──────────────────────────────┐
│ 5.200+ Unit  │  98% Puas    │  Garansi 6 Bulan             │
│ Diperbaiki   │              │                              │
└──────────────┴──────────────┴──────────────────────────────┘
┌─────────────────────────────┬──────────────────────────────┐
│ Servis & Upgrade (wide)     │  Katalog Laptop              │
└─────────────────────────────┴──────────────────────────────┘
┌────────────────────────────────────────────────────────────┐
│ Pusat Sparepart Original (full width)                      │
└────────────────────────────────────────────────────────────┘
```

### 6. `how-it-works.blade.php`

**Perubahan dari dark ke light:**
- Border garis dekorasi: `via-cyan-500/20` → `via-sky-300/40`
- `.bento-card` dark → `bg-white` light
- Badge: `bg-cyan-500/10 text-cyan-400` → `bg-sky-50 border-sky-200 text-sky-700`
- Step number circles: `bg-cyan-400/20` → `bg-sky-100 border-sky-300`
- Step icon boxes: `bg-cyan-400/10` → `bg-sky-50`
- Icon colors: `text-cyan-400` / `text-emerald-400` → `text-sky-600` / `text-emerald-600`
- Connector line: `from-cyan-500/10` → `from-sky-300/30`

### 7. `site-footer.blade.php`

**Perubahan dari dark ke light:**
- Footer bg: implicit dark → `bg-slate-900` (dark lembut — kontras terhadap body light untuk visual closure)
- Alternatif: `bg-slate-800` dengan teks `text-slate-300`
- Border top: `border-slate-800/60` → `border-slate-700`
- Copyright: **tidak berubah** — tetap `{{ date('Y') }}` dinamis
- Logo aksen: `text-cyan-400` → `text-sky-400`
- Link hover: `hover:text-cyan-400` → `hover:text-sky-400`

> **Catatan keputusan desain:** Footer menggunakan `bg-slate-900` (dark) untuk memberikan visual "closure" pada halaman, menciptakan kontras yang jelas antara konten light di atas dengan footer gelap di bawah. Ini adalah pola umum pada desain SaaS/landing page modern.

### 8. `ResiController.php` *(BARU)*

```php
// app/Http/Controllers/ResiController.php

public function track(Request $request): JsonResponse
{
    $validated = $request->validate([
        'resi' => ['required', 'string', 'regex:/^SRV-\d{4}$/'],
    ]);

    $order = ServiceOrder::where('resi', $validated['resi'])->first();

    if (! $order) {
        return response()->json([
            'found'   => false,
            'message' => 'Nomor resi tidak ditemukan.',
        ], 404);
    }

    return response()->json([
        'found'    => true,
        'resi'     => $order->resi,
        'status'   => $order->status,
        'estimasi' => $order->estimasi,
    ]);
}
```

> **Catatan:** Jika tabel `service_orders` belum ada, endpoint dapat mengembalikan data statis/demo untuk keperluan redesign visual. Migration dan model `ServiceOrder` dapat dibuat pada sprint berikutnya. Sementara itu, controller mengembalikan dummy data berdasarkan format resi yang valid.

---

## Data Models

### ServiceOrder (Future Model)

Untuk mendukung endpoint lacak resi secara penuh, model berikut perlu dibuat:

| Kolom       | Tipe        | Deskripsi                                      |
|-------------|-------------|------------------------------------------------|
| `id`        | bigint (PK) | Auto-increment                                 |
| `resi`      | varchar(20) | Nomor resi unik, format `SRV-XXXX`, indexed    |
| `status`    | varchar(50) | Status servis (Diterima, Dikerjakan, Selesai)  |
| `estimasi`  | varchar(100)| Estimasi waktu selesai                         |
| `created_at`| timestamp   | Waktu order masuk                              |
| `updated_at`| timestamp   | Waktu update terakhir                          |

Format resi: `SRV-` diikuti tepat 4 digit angka (regex: `^SRV-\d{4}$`).

### CSS Utility Classes (Light Mode)

Kelas-kelas CSS custom yang perlu diganti/ditambah di `app.css`:

| Old (Dark)          | New (Light)                                  | Kegunaan               |
|---------------------|----------------------------------------------|------------------------|
| `.nav-glass`        | `.nav-light` → `bg-white/80 backdrop-blur`   | Navbar background      |
| `.bento-card`       | `.bento-card-light` → `bg-white border...`   | Semua kartu            |
| `.grid-bg`          | *(hapus atau jadikan opsional)*              | Hero background        |
| `.btn-cta-glow`     | `.btn-cta-light` → `bg-sky-500 text-white`   | CTA buttons            |
| `.btn-ghost`        | `.btn-ghost-light` → `border-sky-300 text-sky-600` | Secondary buttons |
| scrollbar dark      | scrollbar light `bg-slate-200`               | Custom scrollbar       |
| `.text-glow-cyan`   | *(hapus — tidak cocok di light mode)*        | Text glow              |

---

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system — essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

Dari hasil analisis prework, sebagian besar acceptance criteria bersifat visual/UI (EXAMPLE) yang tidak cocok untuk property-based testing. Namun terdapat dua kriteria backend yang memenuhi syarat PBT: validasi format resi dan respons endpoint tracking.

### Property 1: Resi valid mengembalikan respons JSON terstruktur

*For any* string yang cocok dengan format `SRV-` diikuti tepat 4 digit angka (mis. `SRV-0001`, `SRV-9999`), endpoint `POST /resi/track` SHALL mengembalikan respons JSON dengan kode HTTP 200 atau 404 (bukan 422) dan selalu mengandung kunci `found`.

**Validates: Requirements 2.4**

### Property 2: Input resi invalid selalu ditolak dengan error validasi

*For any* string yang kosong, tidak dimulai dengan `SRV-`, atau mengandung karakter non-digit setelah `SRV-`, endpoint `POST /resi/track` SHALL mengembalikan HTTP 422 (Unprocessable Entity) dengan body JSON mengandung kunci `errors`.

**Validates: Requirements 2.5**

### Property 3: Copyright footer selalu mengandung tahun saat ini

*For any* saat halaman dirender, komponen footer SHALL menampilkan angka tahun yang sama dengan `date('Y')` pada saat rendering — sehingga tidak pernah menampilkan tahun yang sudah lewat.

**Validates: Requirements 5.3**

---

## Error Handling

### AJAX Resi Tracker (Frontend)

```javascript
// resources/js/app.js — resi tracker logic

async function handleCekResi() {
    const resi = inputResi.value.trim();

    // Guard: empty or wrong prefix
    if (!resi || !resi.startsWith('SRV-')) {
        showResiResult('warning',
            'Format tidak valid. Gunakan format SRV-XXXX.');
        return;
    }

    // Loading state
    btnCekResi.disabled = true;
    showResiResult('loading', 'Mencari data servis...');

    try {
        const response = await fetch('/resi/track', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
            },
            body: JSON.stringify({ resi }),
        });

        const data = await response.json();

        if (response.status === 422) {
            // Validation error from server
            showResiResult('error', data.message
                ?? 'Format resi tidak valid.');
        } else if (response.status === 404 || !data.found) {
            showResiResult('not-found',
                `Resi <strong>${resi}</strong> tidak ditemukan.`);
        } else {
            showResiResult('success', data);
        }
    } catch (err) {
        showResiResult('error',
            'Terjadi kesalahan jaringan. Coba lagi.');
    } finally {
        btnCekResi.disabled = false;
    }
}
```

### State Rendering `#resi-result`

| State      | Warna indikator | Isi pesan                                        |
|------------|-----------------|--------------------------------------------------|
| `loading`  | sky/blue spinner| "Mencari data servis..."                         |
| `success`  | emerald         | Nomor resi, status, estimasi selesai             |
| `not-found`| amber/orange    | "Resi SRV-XXXX tidak ditemukan"                  |
| `warning`  | amber           | "Format tidak valid. Gunakan format SRV-XXXX."   |
| `error`    | red             | "Terjadi kesalahan jaringan. Coba lagi."         |

### Server-Side (ResiController)

- Validasi format menggunakan Laravel `validate()` — otomatis mengembalikan HTTP 422 dengan JSON errors saat request `Accept: application/json`.
- Model not found menggunakan kondisi `if (! $order)` → kembalikan 404 JSON (bukan throw `ModelNotFoundException`).
- Semua exception tertangani oleh Laravel exception handler default yang sudah mengembalikan JSON untuk request AJAX.

---

## Testing Strategy

### Penilaian PBT

Fitur ini sebagian besar adalah UI rendering (Blade template + Tailwind classes). Sebagian besar kriteria acceptance merupakan **EXAMPLE** tests. Dua kriteria bersifat **PROPERTY** (validasi resi). PBT diterapkan hanya untuk lapisan backend logic, bukan untuk rendering visual.

### Unit Tests (PHPUnit — `php artisan make:test`)

**ResiControllerTest** (Feature Test):

1. `test_valid_resi_format_returns_json_response` — POST `SRV-1234` → assert HTTP 200 atau 404, JSON has `found` key
2. `test_empty_resi_returns_validation_error` — POST `""` → assert HTTP 422
3. `test_invalid_format_without_prefix_returns_validation_error` — POST `"1234"` → assert HTTP 422
4. `test_invalid_format_with_letters_after_prefix_returns_validation_error` — POST `"SRV-ABCD"` → assert HTTP 422
5. `test_valid_resi_not_in_database_returns_not_found` — POST `SRV-9999` (tidak ada di DB) → assert HTTP 404, `found == false`

**WelcomePageTest** (Feature Test):

6. `test_welcome_page_loads_successfully` — GET `/` → assert HTTP 200
7. `test_hero_section_contains_badge_text` — assert response contains `Terpercaya Sejak 2018`
8. `test_social_proof_bar_contains_brand_names` — assert response contains `ASUS`, `Lenovo`, `Acer`, `HP`, `MSI`
9. `test_footer_contains_current_year` — assert response contains `date('Y')`
10. `test_navbar_contains_whatsapp_cta` — assert response contains `Hubungi WhatsApp`

### Property-Based Tests

Menggunakan **eris/eris** (PHP property-based testing library) atau dapat diimplementasikan menggunakan generator manual di PHPUnit DataProvider. Karena PHP ecosystem tidak memiliki library PBT se-mature Hypothesis, gunakan **PHPUnit DataProvider** dengan generated dataset sebagai pragmatic alternative.

**Property Test 1: Valid resi formats always get non-422 response**

```php
// Jalankan untuk semua kombinasi SRV-0000 hingga SRV-9999
#[DataProvider('validResiProvider')]
public function test_valid_resi_format_is_accepted(string $resi): void
{
    $response = $this->postJson('/resi/track', ['resi' => $resi]);
    $response->assertStatus(fn($status) => in_array($status, [200, 404]));
    $response->assertJsonHasKey('found');
}

public static function validResiProvider(): array {
    // Generate sample dari rentang valid
    return array_map(
        fn($n) => [sprintf('SRV-%04d', $n)],
        range(0, 9999, 100) // 100 samples
    );
}
```

Tag: `Feature: landing-page-redesign, Property 1: valid resi returns structured JSON`

**Property Test 2: Invalid resi formats always get 422**

```php
#[DataProvider('invalidResiProvider')]
public function test_invalid_resi_format_is_rejected(string $resi): void
{
    $response = $this->postJson('/resi/track', ['resi' => $resi]);
    $response->assertStatus(422);
    $response->assertJsonHasKey('errors');
}

public static function invalidResiProvider(): array {
    return [
        [''],           // empty
        ['SRV-'],       // no digits
        ['SRV-12'],     // too short
        ['SRV-12345'],  // too long
        ['SRV-ABCD'],   // letters not digits
        ['1234'],       // no prefix
        ['srv-1234'],   // lowercase prefix
        ['SRV 1234'],   // space instead of dash
        // ... tambahan generated invalid strings
    ];
}
```

Tag: `Feature: landing-page-redesign, Property 2: invalid resi always rejected`

### Integration Tests

- Render `welcome.blade.php` end-to-end (GET `/`) dan assert semua section hadir.
- Assert urutan DOM: hero → social-proof-bar → services → how-it-works → footer.

### Test Konfigurasi

- Minimum **100 iterasi** untuk property tests (via DataProvider range atau loop).
- Jalankan: `php artisan test --compact tests/Feature/ResiControllerTest.php`
- Jalankan semua: `php artisan test --compact`
