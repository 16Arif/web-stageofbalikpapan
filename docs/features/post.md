# Master Plan Fitur Post: Berita dan Aktifitas

Dokumen ini adalah panduan implementasi khusus untuk fitur Post pada website Stageof Balikpapan. Scope fitur ini mencakup pengelolaan Berita dan Aktifitas melalui admin panel, penayangan daftar berita publik, detail berita, filter kategori, halaman penulis, dan integrasi ringkasan berita terbaru di homepage.

Dokumen ini sengaja dibuat operasional agar bisa dikerjakan oleh junior programmer atau AI agent secara bertahap.

## Tujuan Fitur

Fitur Post harus memungkinkan admin mengelola konten Berita dan Aktifitas tanpa mengubah kode, lalu menampilkannya ke publik secara aman, rapi, cepat, dan SEO-friendly.

Target akhir:

- Admin dapat membuat, mengedit, menyimpan draft, menjadwalkan, publish, unpublish, dan mengarsipkan post.
- Post publik hanya menampilkan konten yang sudah published.
- Halaman `/activity` menampilkan daftar post dengan pagination dan filter.
- Halaman detail post memiliki metadata SEO dan data artikel yang lengkap.
- Homepage menampilkan 3 post terbaru dari database.
- Tidak ada post draft atau scheduled yang bocor ke publik.

## Review Kondisi Saat Ini

### Yang Sudah Ada

- Model `Post`, `Category`, dan `Author`.
- Migration awal untuk tabel `posts`, `categories`, dan `authors`.
- Relation `category_id` dan `author_id` di tabel `posts`.
- Controller publik `PostController`.
- Route publik:
  - `/activity`
  - `/activity/author/{author:slug}`
  - `/activity/{post:slug}`
- View publik:
  - `resources/views/pages/posts/index.blade.php`
  - `resources/views/pages/posts/show.blade.php`
- Seeder dan factory untuk post, category, dan author.

### Masalah Utama

#### P0 - Post belum memiliki workflow publikasi

Lokasi:

- `app/Http/Controllers/PostController.php`
- `app/Models/Post.php`
- `database/migrations/2026_05_16_000003_create_posts_table.php`

Masalah:

- Belum ada kolom `status`.
- Belum ada konsep draft, scheduled, published, archived.
- Controller publik mengambil semua post.
- Post dengan `published_at` masa depan tetap berpotensi tampil.

Risiko:

- Draft bisa tampil ke publik.
- Konten yang belum disetujui dapat terindeks search engine.

#### P0 - List post belum memakai pagination

Lokasi:

- `app/Http/Controllers/PostController.php`

Masalah:

- Query memakai `get()`.
- Jika data banyak, halaman `/activity` akan semakin berat.

Target:

- Gunakan `paginate(9)` atau `simplePaginate(9)`.

#### P1 - Data post masih duplikatif

Lokasi:

- `app/Models/Post.php`
- migration `posts`

Masalah:

- Ada kolom string `category` dan `author`.
- Ada juga `category_id` dan `author_id`.

Risiko:

- Nama kategori/penulis bisa tidak sinkron.
- Developer bingung menentukan sumber data utama.

Rekomendasi:

- Jadikan `category_id` dan `author_id` sebagai sumber utama.
- Kolom string `category` dan `author` hanya dipakai sebagai legacy fallback sementara, atau dihapus jika database belum production.

#### P1 - Relasi author/category nullable tetapi view menganggap selalu ada

Lokasi:

- `resources/views/pages/posts/show.blade.php`
- migration relation post

Masalah:

- View membuat route author dari `$post->authorRelation`.
- Jika author kosong, route dapat error.

Rekomendasi:

- Untuk Post publik, `category_id` dan `author_id` wajib.
- Validasi ini diberlakukan di Filament Resource dan database.

#### P1 - Belum ada CMS Resource untuk Post

Lokasi:

- `app/Filament/Resources`

Masalah:

- Saat ini baru ada `UserResource`.
- Belum ada `PostResource`, `CategoryResource`, dan `AuthorResource`.

Target:

- Admin bisa mengelola seluruh konten berita dari Filament.

#### P2 - Homepage section masih hard-coded

Lokasi:

- `resources/views/components/ui/sections/activity-news.blade.php`

Masalah:

- Card berita masih statis.
- Link masih `#`.

Target:

- Ambil 3 post published terbaru dari database.

## Batasan Scope

Termasuk dalam scope:

- Model, migration, seeder, factory untuk Post, Category, Author.
- Filament CMS Resource untuk Post, Category, Author.
- Public route dan controller untuk list, detail, author, category.
- View list dan detail post.
- Homepage latest posts section.
- SEO metadata untuk list dan detail post.
- Test untuk fitur Post.

Tidak termasuk dalam scope:

- Redesign total website.
- Modul cuaca/gempa/petir.
- Halaman profil, pelayanan, buletin statis.
- Role permission lengkap seluruh website, kecuali minimal gate untuk akses resource Post jika dibutuhkan.
- Integrasi API eksternal.

## Fase 1 - Stabilkan Schema Post

Tujuan:

Membuat struktur data Post siap production.

Status:

Selesai pada migration `database/migrations/2026_05_30_151500_update_posts_table_for_publication_workflow.php`.

Task:

- [x] Tambahkan migration baru untuk kolom:
  - `status` string default `draft`.
  - `featured_image` nullable.
  - `meta_title` nullable.
  - `meta_description` nullable.
  - `published_at` nullable.
- [x] Tambahkan index:
  - `status`
  - `published_at`
  - `category_id`
  - `author_id`
  - kombinasi `status, published_at`
- [x] Putuskan strategi kolom lama:
  - Kolom `category`, `author`, dan `img` dipertahankan sebagai legacy fallback.
  - Nilai `img` dimigrasikan awal ke `featured_image` jika `featured_image` masih kosong.
- [x] Jadikan `category_id` dan `author_id` wajib untuk post yang akan dipublish.
  - Dicatat sebagai aturan data untuk fase CMS/validasi, belum dijadikan non-null database constraint di Fase 1.
- [x] Jika memungkinkan, ubah database constraint menjadi non-null setelah data legacy bersih.
  - Ditunda karena migration existing masih nullable dan data legacy perlu dibersihkan lebih dulu.

Acceptance criteria:

- Tabel `posts` punya status dan metadata SEO.
- Post dapat disimpan sebagai draft tanpa `published_at`.
- Post published wajib memiliki `published_at`, category, author, title, excerpt, content.

Catatan implementasi:

- Jangan menghapus kolom lama secara agresif jika sudah ada data production.
- Untuk tahap aman, tambahkan kolom baru dulu, lalu migrasi data pada fase terpisah.
- Fase 1 memilih jalur aman: additive migration, legacy column tetap ada, dan constraint non-null untuk `category_id`/`author_id` ditunda.
- Validasi yang sudah dijalankan:
  - `php -l database/migrations/2026_05_30_151500_update_posts_table_for_publication_workflow.php`
  - `php artisan migrate --pretend`
  - `php artisan test`

## Fase 2 - Perkuat Model Post

Tujuan:

Membuat logic publikasi terpusat di model.

Status:

Selesai pada `app/Models/Post.php`.

Task:

- [x] Tambahkan constant status di `Post`:
  - `STATUS_DRAFT = 'draft'`
  - `STATUS_SCHEDULED = 'scheduled'`
  - `STATUS_PUBLISHED = 'published'`
  - `STATUS_ARCHIVED = 'archived'`
- [x] Tambahkan method:
  - `isPublished(): bool`
  - `isDraft(): bool`
  - `isScheduled(): bool`
- [x] Tambahkan scope:
  - `scopePublished($query)`
  - `scopeLatestPublished($query)`
  - `scopeForCategory($query, Category|string|null $category)`
  - `scopeForAuthor($query, Author|string|null $author)`
- [x] Tambahkan relation standar:
  - `category()`
  - `author()`
- [x] Jika relation lama `categoryRelation()` dan `authorRelation()` masih dipakai view, pertahankan sementara sebagai alias.
- [x] Tambahkan accessor `image_url`.
- [x] Accessor image harus mendukung:
  - file upload lokal/storage.
  - URL eksternal lama jika masih ada data lama.
  - fallback image lokal jika kosong.
- [x] Update `$fillable`.
- [x] Update `$casts`:
  - `published_at` sebagai `datetime`.
  - `date` tetap dipertahankan sebagai legacy cast.

Acceptance criteria:

- Semua query publik memakai scope model.
- Controller tidak mengulang logic `status = published`.
- Detail post unpublished dapat ditolak dengan satu method/scope.

Catatan implementasi:

- `category()` dan `author()` ditambahkan sebagai relation standar.
- `categoryRelation()` dan `authorRelation()` tetap dipertahankan agar controller/view lama tidak rusak sebelum Fase 3 dan Fase 5.
- `image_url` memakai prioritas `featured_image`, lalu legacy `img`, lalu fallback lokal `favicon.ico`.
- Validasi yang sudah dijalankan:
  - `php -l app/Models/Post.php`
  - `php artisan test`

Contoh ekspektasi scope:

```php
Post::query()
    ->published()
    ->with(['category', 'author'])
    ->latestPublished()
    ->paginate(9);
```

## Fase 3 - Update Controller Publik

Tujuan:

Membuat route publik aman, scalable, dan mudah dipakai.

Status:

Selesai pada `app/Http/Controllers/PostController.php`.

Task untuk `index`:

- [x] Gunakan `Post::published()`.
- [x] Eager load `category` dan `author`.
- [x] Ambil category filter dari query string `category`.
- [x] Jika category slug tidak ditemukan, tampilkan empty state atau redirect ke `/activity`.
  - Implementasi saat ini: query dibuat kosong agar view menampilkan empty state.
- [x] Gunakan `paginate(9)`.
- [x] Gunakan `withQueryString()` agar filter tetap saat pindah halaman.
- [x] Kirim data SEO page title dan description ke view.

Task untuk `show`:

- [x] Route model binding tetap berdasarkan slug.
- [x] Jika post tidak published, `abort(404)`.
- [x] Load `category` dan `author`.
- [x] Ambil related posts:
  - status published.
  - category sama.
  - exclude post aktif.
  - limit 3.
- [x] Kirim meta title, meta description, canonical URL, dan image ke view.

Task untuk `byAuthor`:

- [x] Gunakan post published saja.
- [x] Eager load category dan author.
- [x] Gunakan pagination.
- [x] Support filter category jika masih dibutuhkan.
- [x] Tampilkan empty state jika belum ada post.

Opsional route category:

- [ ] Tambahkan route `/activity/category/{category:slug}`.
- [ ] Redirect dari `/activity?category=slug` ke route category jika ingin URL lebih rapi.

Acceptance criteria:

- `/activity` hanya menampilkan post published.
- `/activity/{post:slug}` untuk draft menghasilkan 404.
- Pagination muncul jika post lebih dari 9.
- Filter category tidak hilang saat pindah halaman.

Catatan implementasi:

- Relation standar `category` dan `author` sudah dipakai di controller.
- Alias lama `categoryRelation` dan `authorRelation` tetap ikut di-eager-load agar view lama tidak menambah query sampai Fase 5.
- Route category khusus belum dibuat karena bersifat opsional.
- Validasi yang sudah dijalankan:
  - `php -l app/Http/Controllers/PostController.php`
  - `php artisan route:list`
  - `php artisan test`

## Fase 4 - Bangun Filament CMS Resource

Tujuan:

Admin dapat mengelola Berita dan Aktifitas secara lengkap.

Status:

Selesai pada `app/Filament/Resources`.

### PostResource

Field form:

- [x] `title`
  - required.
  - max 255.
- [x] `slug`
  - auto generate dari title.
  - editable.
  - unique.
- [x] `excerpt`
  - required.
  - max 300 atau 500 karakter.
- [x] `content`
  - required.
  - rich editor atau markdown editor.
- [x] `category_id`
  - required.
  - searchable select.
  - preload.
- [x] `author_id`
  - required.
  - searchable select.
  - preload.
- [x] `status`
  - required.
  - options: draft, scheduled, published, archived.
- [x] `published_at`
  - required jika status published atau scheduled.
  - nullable untuk draft.
- [x] `featured_image`
  - image upload.
  - directory `posts`.
  - image editor jika tersedia.
- [x] `meta_title`
  - nullable.
  - max 60 karakter ideal.
- [x] `meta_description`
  - nullable.
  - max 160 karakter ideal.

Table columns:

- [x] title.
- [x] status badge.
- [x] category.
- [x] author.
- [x] published_at.
- [x] updated_at.

Filters:

- [x] status.
- [x] category.
- [x] author.
- [x] published date range.

Actions:

- [x] edit.
- [x] delete.
- [x] publish.
- [x] unpublish/draft.
- [x] duplicate.
- [x] preview.

Validation rules:

- [x] Slug unique.
- [x] Published post wajib punya category dan author.
- [x] Published post wajib punya `published_at`.
- [x] Scheduled post wajib punya `published_at` di masa depan.

### CategoryResource

Field:

- [x] name.
- [x] slug auto generate.
- [x] description nullable.

Table:

- [x] name.
- [x] slug.
- [x] posts count.
- [x] updated_at.

Rules:

- [x] Name unique.
- [x] Slug unique.
- [x] Category yang masih punya post tidak boleh dihapus tanpa konfirmasi.

### AuthorResource

Field:

- [x] name.
- [x] slug auto generate.
- [x] bio nullable.
- [x] photo/avatar nullable.

Table:

- [x] name.
- [x] slug.
- [x] posts count.
- [x] updated_at.

Rules:

- [x] Name unique atau minimal slug unique.
- [x] Author yang masih punya post tidak boleh dihapus tanpa strategi pengganti.

Acceptance criteria:

- Admin dapat membuat post dari Filament dan melihatnya di `/activity` setelah published.
- Admin dapat menyimpan draft tanpa tampil di publik.
- Admin dapat mengubah category dan author tanpa edit database.

## Fase 5 - Update View List Post

Tujuan:

Halaman `/activity` rapi, informatif, dan scalable.

Status:

Selesai pada view list post.

Task:

- [x] Update view agar memakai relation `category` dan `author`.
- [x] Tambahkan pagination links.
- [x] Tambahkan state filter aktif.
- [x] Tambahkan empty state profesional:
  - ketika belum ada post.
  - ketika filter tidak punya hasil.
- [x] Tambahkan search opsional jika diperlukan.
- [x] Gunakan `loading="lazy"` untuk image card.
- [x] Pastikan judul panjang tidak merusak layout.
- [x] Pastikan card clickable area jelas.
- [x] Gunakan tanggal dari `published_at`, bukan `date` legacy.

Acceptance criteria:

- Layout tetap rapi di mobile, tablet, desktop.
- Pagination bisa diklik dan mempertahankan filter.
- Tidak ada error jika image kosong.

## Fase 6 - Update View Detail Post

Tujuan:

Detail post menjadi halaman artikel profesional.

Status:

Selesai pada view detail post.

Task:

- [x] Tampilkan category sebagai link.
- [x] Tampilkan author sebagai link jika author ada.
- [x] Tampilkan tanggal publikasi dari `published_at`.
- [x] Tambahkan featured image dengan alt text.
- [x] Render content dengan aman.
- [x] Jika content memakai rich editor HTML, pastikan sanitization/escape aman.
- [x] Tambahkan related posts.
- [x] Tambahkan breadcrumb:
  - Home
  - Berita dan Aktifitas
  - Judul Post
- [x] Tambahkan share links opsional.

Acceptance criteria:

- Detail post tidak error saat data optional kosong.
- Related posts tampil jika ada.
- Draft post tidak bisa dibuka publik.

## Fase 7 - Dinamiskan Homepage Activity Section

Tujuan:

Homepage menampilkan berita terbaru dari database.

Status:

Selesai pada komponen `ActivityNews`.

Task:

- [x] Update component `ActivityNews`.
- [x] Ambil 3 post published terbaru.
- [x] Eager load category dan author.
- [x] Hapus card hard-coded.
- [x] Semua card link ke detail post.
- [x] Tambahkan link menuju `/activity`.
- [x] Tambahkan empty state jika belum ada post.

Acceptance criteria:

- Publish post baru dari admin langsung muncul di homepage.
- Tidak ada link `#`.
- Section tetap bagus jika post kurang dari 3.

## Fase 8 - SEO Metadata untuk Post

Tujuan:

Post mudah dibagikan dan terindeks dengan metadata yang benar.

Status:

Selesai. Telah diimplementasikan tag meta di app.blade.php, JSON-LD di show.blade.php, dan sitemap dinamis.

Task:

- [x] Tambahkan dukungan meta di layout:
  - title.
  - description.
  - canonical URL.
  - Open Graph title.
  - Open Graph description.
  - Open Graph image.
  - Twitter card.
- [x] Untuk post detail:
  - title default dari post title.
  - description default dari excerpt.
  - image default dari featured image.
- [x] Tambahkan JSON-LD `Article` atau `NewsArticle`.
- [x] Tambahkan `datePublished`.
- [x] Tambahkan `dateModified`.
- [x] Tambahkan `author`.
- [x] Tambahkan sitemap untuk post published.

Acceptance criteria:

- Source HTML post detail memiliki meta title dan description unik.
- Saat dibagikan, image dan excerpt post bisa terbaca oleh platform sosial.
- Draft tidak masuk sitemap.

## Fase 9 - Seeder dan Factory Post

Tujuan:

Data demo mendukung workflow baru.

Status:

Selesai. Telah diimplementasikan factory baru yang realistis.

Task:

- [x] Update `PostFactory` agar menghasilkan status realistis:
  - mayoritas published.
  - sebagian draft.
  - sebagian scheduled.
- [x] Pastikan published post punya `published_at <= now()`.
- [x] Pastikan scheduled post punya `published_at > now()`.
- [x] Pastikan setiap post punya category dan author.
- [x] Update `PostSeeder`.
- [x] Hindari `Post::query()->delete()` jika sudah production.
- [x] Untuk local/demo, boleh truncate dengan guard environment.

Acceptance criteria:

- Seeder dapat membuat data demo yang mencerminkan workflow asli.
- Setelah seed, `/activity` hanya menampilkan post published.

## Fase 10 - Test Plan

Tujuan:

Mencegah regresi fitur Post.

Feature tests:

- [ ] `/activity` dapat dibuka.
- [ ] `/activity` hanya menampilkan post published.
- [ ] `/activity` tidak menampilkan draft.
- [ ] `/activity` tidak menampilkan scheduled masa depan.
- [ ] Filter category bekerja.
- [ ] Pagination bekerja.
- [ ] Halaman author bekerja.
- [ ] Detail post published dapat dibuka.
- [ ] Detail post draft menghasilkan 404.
- [ ] Detail post scheduled masa depan menghasilkan 404.
- [ ] Homepage menampilkan latest published posts.

Model tests:

- [ ] `scopePublished()` hanya mengambil published yang waktunya valid.
- [ ] `isPublished()` benar untuk status dan tanggal.
- [ ] `image_url` memberi fallback saat image kosong.

Filament/admin tests jika memungkinkan:

- [ ] Admin bisa membuat post draft.
- [ ] Admin bisa publish post.
- [ ] Slug duplicate ditolak.
- [ ] Published post tanpa category/author ditolak.

Acceptance criteria:

- `php artisan test` hijau.
- Minimal test publik untuk draft leakage wajib ada.

## Fase 11 - Dokumentasi Fitur Post

Tujuan:

Admin dan developer tahu cara memakai fitur ini.

Task:

- [ ] Tambahkan dokumentasi developer:
  - struktur model Post.
  - status workflow.
  - route publik.
  - cara menjalankan test Post.
- [ ] Tambahkan dokumentasi admin:
  - cara membuat post.
  - cara menyimpan draft.
  - cara publish.
  - cara menjadwalkan post.
  - cara mengganti featured image.
  - cara mengisi SEO title dan description.

Acceptance criteria:

- Developer baru bisa melanjutkan fitur Post tanpa membaca seluruh codebase.
- Admin tahu bedanya draft, scheduled, published, archived.

## Urutan Pengerjaan yang Disarankan

Kerjakan dalam PR kecil:

1. Schema status dan metadata post.
2. Model scope dan relation cleanup.
3. Controller publik dengan pagination dan published filter.
4. Filament PostResource.
5. Filament CategoryResource dan AuthorResource.
6. View list dan detail post.
7. Homepage latest posts.
8. SEO metadata post.
9. Seeder/factory update.
10. Test fitur Post.
11. Dokumentasi fitur Post.

Setiap PR wajib:

- Fokus pada satu fase kecil.
- Tidak melakukan redesign global.
- Tidak mengubah modul gempa/cuaca/petir.
- Menjalankan `php artisan test`.
- Menjalankan `npm run build` jika menyentuh view/CSS/JS.
- Mencatat hasil test di deskripsi PR.

## Definition of Done

Fitur Post dianggap selesai jika:

- Admin bisa CRUD Post, Category, dan Author dari Filament.
- Post punya workflow draft, scheduled, published, archived.
- Halaman publik hanya menampilkan post published.
- Draft dan scheduled tidak bisa diakses publik.
- List post memakai pagination.
- Detail post memiliki SEO metadata.
- Homepage menampilkan post terbaru dari database.
- Seeder dan factory sesuai workflow baru.
- Test utama fitur Post hijau.
- Dokumentasi fitur Post tersedia.

## Prompt Singkat untuk AI Agent

Gunakan prompt ini jika fase tertentu diberikan ke AI agent cepat:

```text
Kerjakan hanya fitur Post: Berita dan Aktifitas di Laravel project Stageof Balikpapan. Ikuti issue.md. Ambil satu fase kecil saja. Jangan redesign global dan jangan ubah modul gempa/cuaca/petir. Pastikan post publik hanya status published dengan published_at <= now(). Jalankan php artisan test dan npm run build jika menyentuh view/CSS/JS. Laporkan hasil test dan file yang berubah.
```
