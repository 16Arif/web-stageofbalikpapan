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

---

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi (stack) modern yang tangguh untuk memastikan performa, keamanan, dan pengalaman antarmuka yang optimal:

- **Framework:** Laravel 12.0 (PHP 8.4)
- **Styling:** Tailwind CSS (beserta komponen UI kustom yang responsif)
- **Admin Panel:** Filament Admin (TALL Stack: Tailwind, Alpine, Laravel, Livewire)
- **Database:** MySQL / SQLite

---

## Instruksi Instalasi Singkat

Bagi pengembang (developer) yang ingin memasang dan menjalankan sistem ini di lingkungan lokal, ikuti langkah-langkah dasar berikut:

1. **Kloning Repositori**
   ```bash
   git clone <url-repo-anda>
   cd web-stageofbalikpapan
   ```

2. **Instalasi Dependensi Backend & Frontend**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Konfigurasi Lingkungan (Environment)**
   Salin file konfigurasi bawaan dan sesuaikan pengaturan *database* Anda:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi dan *Seeding* Database**
   Siapkan struktur tabel beserta data *dummy* awal (Berita, Buletin, dan *User* Admin):
   ```bash
   php artisan migrate:fresh --seed
   ```
   *(Peringatan: Perintah ini akan menghapus semua data yang ada di database saat ini)*

5. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Aplikasi publik dapat diakses melalui `http://localhost:8000`.

---

## Catatan Pengembangan

Sistem portal publik ini dirancang agar dapat dikelola sepenuhnya oleh petugas operasional (UPT) melalui *dashboard administrator* terintegrasi. Segala konten dinamis seperti Berita, Buletin, dan Informasi Terkini dikonfigurasi melalui panel admin tanpa harus mengubah *source code* secara langsung. 

Bagi pengembang lanjutan, pastikan pembuatan *Resource* tambahan di masa mendatang selalu mematuhi pedoman penamaan (Language/Naming Convention) berbahasa Indonesia baku seperti yang disyaratkan di dalam aturan pengembangan (`AI_RULES.md`).
