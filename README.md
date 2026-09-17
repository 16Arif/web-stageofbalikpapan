# Portal Informasi Geofisika & Publikasi
**UPT Stasiun Geofisika Balikpapan**

Portal Informasi Geofisika & Publikasi adalah sistem informasi berbasis website yang dibangun menggunakan *framework* Laravel. Sistem ini dirancang secara khusus untuk menyajikan diseminasi informasi kegempaan, geofisika potensial, edukasi mitigasi kebencanaan, serta publikasi resmi dari Pusat Gempa Regional XI secara dinamis, akurat, dan profesional.

---

## Struktur Modul

Sistem ini dikelompokkan ke dalam beberapa modul utama untuk memudahkan navigasi pengguna masyarakat dan pengelolaan oleh petugas UPT:

- **Geofisika**
  - **Hilal:** Informasi pengamatan rukyatul hilal awal bulan qamariyah.
  - **Gerhana:** Data dan informasi pengamatan gerhana matahari maupun bulan.
  - **Petir:** Diseminasi data aktivitas sambaran petir.
  - **Peta Kejadian & Kerapatan Petir:** Analisis geospasial aktivitas petir dalam periode tertentu.

- **Gempabumi**
  - **Gempa Terkini:** Informasi kejadian gempabumi terbaru (M ≥ 5.0 atau dirasakan).
  - **Gempa Kalimantan:** Informasi khusus kejadian gempabumi di wilayah Pulau Kalimantan.
  - **Peta Seismisitas:** Visualisasi peta sebaran episenter gempabumi.
  - **Mitigasi:** Edukasi dan panduan langkah penyelamatan diri saat terjadi gempabumi.

- **Publikasi**
  - **Berita:** Warta terkini seputar aktivitas operasional, sosialisasi, dan pelayanan publik.
  - **Buletin:** Publikasi berkala hasil analisis geofisika yang dapat diunduh (PDF).

- **Profil**
  - **Profil UPT:** Sejarah, visi-misi, dan tugas pokok instansi.
  - **Struktur Organisasi:** Bagan hierarki dan pejabat fungsional di lingkungan stasiun.

- **Pelayanan**
  - Akses informasi dan portal layanan publik terpadu UPT Stasiun Geofisika Balikpapan.

---

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi (*stack*) modern yang tangguh untuk memastikan performa, keamanan, dan pengalaman antarmuka yang optimal:

- **PHP:** 8.4
- **Framework:** Laravel 12
- **Admin Panel:** Filament v5 (TALL Stack)
- **Komponen Interaktif:** Livewire v4 & Alpine.js
- **Styling:** Tailwind CSS v4
- **Manajemen Peran & Hak Akses:** Spatie Laravel Permission
- **Manajemen Media:** Spatie Media Library
- **Database:** MySQL / PostgreSQL / SQLite
