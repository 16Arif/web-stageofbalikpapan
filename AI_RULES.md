# PROJECT CONTEXT: Web MVP UPT Stasiun Geofisika Balikpapan

## 1. TECH STACK & LINGKUNGAN
- **Backend:** PHP 8.4, Laravel 12.0
- **Frontend/Admin:** Filament v5, Livewire (TALL Stack)
- **Database:** MySQL / SQLite
- **Deployment Target:** aaPanel (Nginx/Apache, Document Root di `/public`)

## 2. ATURAN PENULISAN KODE (BEST PRACTICES)
- **Modern PHP:** Gunakan fitur PHP 8.4 secara maksimal (strict types, constructor property promotion, readonly properties/classes, match expression).
- **Refactoring:** Saat merombak file statis `.blade.php`, prioritaskan penggunaan komponen Livewire untuk interaktivitas, atau Filament Resource/Page untuk halaman manajerial.
- **Efisiensi Database:** Selalu waspada terhadap masalah N+1 query. Gunakan Eager Loading (`with()`) secara proaktif.
- **Clean Code:** Jaga agar Controller tetap ramping (Fat Model, Skinny Controller) atau delegasikan logika bisnis ke struktur `app/Services` atau `app/Actions`.

## 3. ATURAN UI & BAHASA
- **Bahasa Resmi:** Website ini adalah representasi instansi resmi. Gunakan Bahasa Indonesia yang baku, formal, dan profesional untuk seluruh teks UI, label form, pesan notifikasi, dan error validation.
- **Konsistensi Tampilan:** Gunakan utility classes dari Tailwind CSS yang selaras dengan ekosistem Filament/Livewire bawaan.

## 4. ALUR KERJA (MICRO-TASKS)
- Jangan menulis kode untuk banyak fitur sekaligus. Selesaikan satu tugas kecil secara spesifik (misal: hanya membuat Model dan Migration).
- Jika saya meminta perbaikan/refactoring rute, hanya kerjakan rute yang saya sebutkan tanpa mengubah rute lain di `routes/web.php`.
