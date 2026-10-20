# Requirements Document - TeknoFix Redesign

## Introduction

TeknoFix adalah toko komputer dan pusat perbaikan laptop di Jakarta. Dokumentasi ini bertujuan untuk merombak total visual *Landing Page* (`welcome.blade.php`) dari *Dark Theme generic* menjadi **Clean Light Mode** dengan estetika *Bento Grid modern*, *Dual-tone typography*, dan *Floating Cards* berbayangan halus (mengacu pada standar visual SaaS/Fintech modern).

Refactor ini berfokus pada perombakan tata letak (UI/UX) dan restrukturisasi komponen Blade tanpa mengubah *stack* utama (Laravel Blade, Tailwind CSS v4, dan Phosphor Icons).

---

## Glossary

- **Landing_Page**: Halaman utama (`welcome.blade.php`) yang menyusun seluruh komponen UI.
- **Navbar**: Bilah navigasi melayang di bagian atas halaman (`navbar.blade.php`).
- **Hero_Section**: Area utama paling atas dengan *split layout* (pesan nilai + form lacak resi + statistik).
- **Social_Proof_Bar**: Strip logo *brand* laptop yang dilayani di bawah Hero.
- **Bento_Grid**: Tata letak kotak berpola *grid* acak dengan sudut melengkung besar (`rounded-3xl`) dan latar belakang putih bersih (`bg-white`).
- **Services_Section**: Komponen kartu layanan dan keunggulan dalam format Bento_Grid (`services.blade.php`).
- **Resi_Widget**: Komponen interaktif pelacakan resi servis (`SRV-XXXX`).
- **Footer**: Komponen bagian bawah halaman (`site-footer.blade.php`).

---

## Requirements

### Requirement 1: Sistem Desain & Tema Visual Global (Clean Light Mode)

**User Story:** Sebagai Pengunjung, saya ingin melihat tampilan website yang bersih, terang, dan profesional agar terasa terpercaya dan tidak monoton.

#### Acceptance Criteria

1. THE Landing_Page SHALL menggunakan skema warna dasar Light Mode: latar belakang utama `bg-slate-50` (`#F8FAFC`), kartu `bg-white`, teks utama `text-slate-900`, dan teks sekunder `text-slate-500`.
2. THE Landing_Page SHALL menggunakan kartu berestetika Bento_Grid dengan sudut `rounded-3xl`, batas halus `border border-slate-200/80`, dan efek bayangan lembut `shadow-sm hover:shadow-md`.
3. THE Landing_Page SHALL menerapkan *Dual-Tone Typography* pada headline utama (kombinasi kata berwarna gelap tebal dan kata berwarna abu-abu/aksen).
4. THE Landing_Page SHALL menggunakan warna aksen primer cyan/sky blue (`bg-sky-500` atau `bg-teal-600`) khusus untuk elemen interaktif dan tombol CTA.

---

### Requirement 2: Redesain Hero Section & Form Lacak Servis

**User Story:** Sebagai Pengunjung & Pelanggan, saya ingin melihat pesan utama yang tegas serta form lacak servis yang langsung terlihat di area Hero tanpa perlu menelusuri ke bawah.

#### Acceptance Criteria

1. THE Hero_Section SHALL menggunakan tata letak terpisah (*split layout* 2 kolom pada layar desktop >= 1024px): kolom kiri untuk pesan nilai utama dan kolom kanan untuk kartu *floating* status/lacak servis.
2. THE Hero_Section SHALL menampilkan *pill tag badge* "Terpercaya Sejak 2018" di atas headline utama dengan indikator titik *pulse* hijau/cyan.
3. THE Hero_Section SHALL menyediakan *form input resi* ringkas di kolom utama yang berisi field teks dan tombol "Lacak" berdesain *pill-shaped* (`rounded-full`).
4. WHEN Pengunjung memasukkan nomor resi dan mengklik tombol "Lacak", THE Resi_Widget SHALL memproses permintaan secara asinkron (AJAX/Fetch) dan menampilkan status terbaru di area `#resi-result`.
5. IF input resi kosong atau format tidak sesuai (`SRV-`), THEN THE Resi_Widget SHALL menampilkan pesan peringatan langsung di area `#resi-result`.

---

### Requirement 3: Penambahan Social Proof Bar (Brand Partner)

**User Story:** Sebagai Pengunjung baru, saya ingin melihat logo brand laptop yang dilayani untuk memastikan TeknoFix dapat menangani perangkat saya.

#### Acceptance Criteria

1. THE Landing_Page SHALL menampilkan Social_Proof_Bar tepat di bawah Hero_Section.
2. THE Social_Proof_Bar SHALL menampilkan minimal 5 logo brand laptop populer (ASUS, Lenovo, Acer, HP, MSI, Dell) dengan warna monokrom abu-abu netral agar menyatu dengan latar belakang `bg-slate-50`.
3. WHEN diakses dari perangkat mobile (< 768px), THE Social_Proof_Bar SHALL menampilkan logo dalam format slider horizontal atau grid 3 kolom yang rapi.

---

### Requirement 4: Restrukturisasi Layanan & Statistik (Bento Grid)

**User Story:** Sebagai Pengunjung, saya ingin membaca keunggulan, statistik, dan jenis layanan dalam format kartu yang bervariasi agar informasi mudah dicerna.

#### Acceptance Criteria

1. THE Services_Section SHALL menyusun informasi dalam format Bento_Grid dengan variasi ukuran kartu (besar, sedang, kecil).
2. THE Services_Section SHALL menampilkan minimal 3 angka statistik utama ("5.200+ Unit Diperbaiki", "98% Kepuasan", "Garansi 6 Bulan") menggunakan ukuran teks ekstra besar (`text-4xl` atau `text-5xl`).
3. THE Services_Section SHALL menampilkan kartu layanan utama (Servis Hardware/Software, Upgrade RAM/SSD, Penjualan Laptop) dengan ikon visual bergaya kontemporer.

---

### Requirement 5: Navbar & Footer Clean Style

**User Story:** Sebagai Pengunjung, saya ingin navigasi yang tetap bersih dan mengikuti tema terang di seluruh bagian halaman.

#### Acceptance Criteria

1. THE Navbar SHALL melayang (*fixed top*) dengan latar belakang `bg-white/80` dan efek *backdrop-blur* agar konten di bawahnya samar saat di-scroll.
2. THE Navbar SHALL menampilkan tombol CTA "Hubungi WhatsApp" berdesain *pill-shaped* menonjol di sebelah kanan.
3. THE Footer SHALL menggunakan latar belakang netral terang/gelap lembut yang konsisten, menampilkan navigasi cepat, alamat toko, dan hak cipta dinamis `date('Y')`.
4. WHEN diakses dari perangkat mobile (< 1024px), THE Navbar SHALL menyembunyikan link horizontal dan menyediakan tombol *hamburger menu* interaktif.