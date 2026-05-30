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

Task:

- [ ] Tambahkan migration baru untuk kolom:
  - `status` string default `draft`.
  - `featured_image` nullable.
  - `meta_title` nullable.
  - `meta_description` nullable.
  - `published_at` nullable.
- [ ] Tambahkan index:
  - `status`
  - `published_at`
  - `category_id`
  - `author_id`
  - kombinasi `status, published_at`
- [ ] Putuskan strategi kolom lama:
  - Jika database belum production, hapus `category`, `author`, dan `img`.
  - Jika database sudah punya data, migrasikan `img` ke `featured_image`, lalu jadikan field lama legacy sementara.
- [ ] Jadikan `category_id` dan `author_id` wajib untuk post yang akan dipublish.
- [ ] Jika memungkinkan, ubah database constraint menjadi non-null setelah data legacy bersih.

Acceptance criteria:

- Tabel `posts` punya status dan metadata SEO.
- Post dapat disimpan sebagai draft tanpa `published_at`.
- Post published wajib memiliki `published_at`, category, author, title, excerpt, content.

Catatan implementasi:

- Jangan menghapus kolom lama secara agresif jika sudah ada data production.
- Untuk tahap aman, tambahkan kolom baru dulu, lalu migrasi data pada fase terpisah.

## Fase 2 - Perkuat Model Post

Tujuan:

Membuat logic publikasi terpusat di model.

Task:

- [ ] Tambahkan constant status di `Post`:
  - `STATUS_DRAFT = 'draft'`
  - `STATUS_SCHEDULED = 'scheduled'`
  - `STATUS_PUBLISHED = 'published'`
  - `STATUS_ARCHIVED = 'archived'`
- [ ] Tambahkan method:
  - `isPublished(): bool`
  - `isDraft(): bool`
  - `isScheduled(): bool`
- [ ] Tambahkan scope:
  - `scopePublished($query)`
  - `scopeLatestPublished($query)`
  - `scopeForCategory($query, Category|string|null $category)`
  - `scopeForAuthor($query, Author|string|null $author)`
- [ ] Tambahkan relation standar:
  - `category()`
  - `author()`
- [ ] Jika relation lama `categoryRelation()` dan `authorRelation()` masih dipakai view, pertahankan sementara sebagai alias.
- [ ] Tambahkan accessor `image_url`.
- [ ] Accessor image harus mendukung:
  - file upload lokal/storage.
  - URL eksternal lama jika masih ada data lama.
  - fallback image lokal jika kosong.
- [ ] Update `$fillable`.
- [ ] Update `$casts`:
  - `published_at` sebagai `datetime`.
  - `date` dipertimbangkan untuk dihapus atau tetap legacy.

Acceptance criteria:

- Semua query publik memakai scope model.
- Controller tidak mengulang logic `status = published`.
- Detail post unpublished dapat ditolak dengan satu method/scope.

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

Task untuk `index`:

- [ ] Gunakan `Post::published()`.
- [ ] Eager load `category` dan `author`.
- [ ] Ambil category filter dari query string `category`.
- [ ] Jika category slug tidak ditemukan, tampilkan empty state atau redirect ke `/activity`.
- [ ] Gunakan `paginate(9)`.
- [ ] Gunakan `withQueryString()` agar filter tetap saat pindah halaman.
- [ ] Kirim data SEO page title dan description ke view.

Task untuk `show`:

- [ ] Route model binding tetap berdasarkan slug.
- [ ] Jika post tidak published, `abort(404)`.
- [ ] Load `category` dan `author`.
- [ ] Ambil related posts:
  - status published.
  - category sama.
  - exclude post aktif.
  - limit 3.
- [ ] Kirim meta title, meta description, canonical URL, dan image ke view.

Task untuk `byAuthor`:

- [ ] Gunakan post published saja.
- [ ] Eager load category dan author.
- [ ] Gunakan pagination.
- [ ] Support filter category jika masih dibutuhkan.
- [ ] Tampilkan empty state jika belum ada post.

Opsional route category:

- [ ] Tambahkan route `/activity/category/{category:slug}`.
- [ ] Redirect dari `/activity?category=slug` ke route category jika ingin URL lebih rapi.

Acceptance criteria:

- `/activity` hanya menampilkan post published.
- `/activity/{post:slug}` untuk draft menghasilkan 404.
- Pagination muncul jika post lebih dari 9.
- Filter category tidak hilang saat pindah halaman.

## Fase 4 - Bangun Filament CMS Resource

Tujuan:

Admin dapat mengelola Berita dan Aktifitas secara lengkap.

### PostResource

Field form:

- [ ] `title`
  - required.
  - max 255.
- [ ] `slug`
  - auto generate dari title.
  - editable.
  - unique.
- [ ] `excerpt`
  - required.
  - max 300 atau 500 karakter.
- [ ] `content`
  - required.
  - rich editor atau markdown editor.
- [ ] `category_id`
  - required.
  - searchable select.
  - preload.
- [ ] `author_id`
  - required.
  - searchable select.
  - preload.
- [ ] `status`
  - required.
  - options: draft, scheduled, published, archived.
- [ ] `published_at`
  - required jika status published atau scheduled.
  - nullable untuk draft.
- [ ] `featured_image`
  - image upload.
  - directory `posts`.
  - image editor jika tersedia.
- [ ] `meta_title`
  - nullable.
  - max 60 karakter ideal.
- [ ] `meta_description`
  - nullable.
  - max 160 karakter ideal.

Table columns:

- [ ] title.
- [ ] status badge.
- [ ] category.
- [ ] author.
- [ ] published_at.
- [ ] updated_at.

Filters:

- [ ] status.
- [ ] category.
- [ ] author.
- [ ] published date range.

Actions:

- [ ] edit.
- [ ] delete.
- [ ] publish.
- [ ] unpublish/draft.
- [ ] duplicate.
- [ ] preview.

Validation rules:

- [ ] Slug unique.
- [ ] Published post wajib punya category dan author.
- [ ] Published post wajib punya `published_at`.
- [ ] Scheduled post wajib punya `published_at` di masa depan.

### CategoryResource

Field:

- [ ] name.
- [ ] slug auto generate.
- [ ] description nullable.

Table:

- [ ] name.
- [ ] slug.
- [ ] posts count.
- [ ] updated_at.

Rules:

- [ ] Name unique.
- [ ] Slug unique.
- [ ] Category yang masih punya post tidak boleh dihapus tanpa konfirmasi.

### AuthorResource

Field:

- [ ] name.
- [ ] slug auto generate.
- [ ] bio nullable.
- [ ] photo/avatar nullable.

Table:

- [ ] name.
- [ ] slug.
- [ ] posts count.
- [ ] updated_at.

Rules:

- [ ] Name unique atau minimal slug unique.
- [ ] Author yang masih punya post tidak boleh dihapus tanpa strategi pengganti.

Acceptance criteria:

- Admin dapat membuat post dari Filament dan melihatnya di `/activity` setelah published.
- Admin dapat menyimpan draft tanpa tampil di publik.
- Admin dapat mengubah category dan author tanpa edit database.

## Fase 5 - Update View List Post

Tujuan:

Halaman `/activity` rapi, informatif, dan scalable.

Task:

- [ ] Update view agar memakai relation `category` dan `author`.
- [ ] Tambahkan pagination links.
- [ ] Tambahkan state filter aktif.
- [ ] Tambahkan empty state profesional:
  - ketika belum ada post.
  - ketika filter tidak punya hasil.
- [ ] Tambahkan search opsional jika diperlukan.
- [ ] Gunakan `loading="lazy"` untuk image card.
- [ ] Pastikan judul panjang tidak merusak layout.
- [ ] Pastikan card clickable area jelas.
- [ ] Gunakan tanggal dari `published_at`, bukan `date` legacy.

Acceptance criteria:

- Layout tetap rapi di mobile, tablet, desktop.
- Pagination bisa diklik dan mempertahankan filter.
- Tidak ada error jika image kosong.

## Fase 6 - Update View Detail Post

Tujuan:

Detail post menjadi halaman artikel profesional.

Task:

- [ ] Tampilkan category sebagai link.
- [ ] Tampilkan author sebagai link jika author ada.
- [ ] Tampilkan tanggal publikasi dari `published_at`.
- [ ] Tambahkan featured image dengan alt text.
- [ ] Render content dengan aman.
- [ ] Jika content memakai rich editor HTML, pastikan sanitization/escape aman.
- [ ] Tambahkan related posts.
- [ ] Tambahkan breadcrumb:
  - Home
  - Berita dan Aktifitas
  - Judul Post
- [ ] Tambahkan share links opsional.

Acceptance criteria:

- Detail post tidak error saat data optional kosong.
- Related posts tampil jika ada.
- Draft post tidak bisa dibuka publik.

## Fase 7 - Dinamiskan Homepage Activity Section

Tujuan:

Homepage menampilkan berita terbaru dari database.

Task:

- [ ] Update component `ActivityNews`.
- [ ] Ambil 3 post published terbaru.
- [ ] Eager load category dan author.
- [ ] Hapus card hard-coded.
- [ ] Semua card link ke detail post.
- [ ] Tambahkan link menuju `/activity`.
- [ ] Tambahkan empty state jika belum ada post.

Acceptance criteria:

- Publish post baru dari admin langsung muncul di homepage.
- Tidak ada link `#`.
- Section tetap bagus jika post kurang dari 3.

## Fase 8 - SEO Metadata untuk Post

Tujuan:

Post mudah dibagikan dan terindeks dengan metadata yang benar.

Task:

- [ ] Tambahkan dukungan meta di layout:
  - title.
  - description.
  - canonical URL.
  - Open Graph title.
  - Open Graph description.
  - Open Graph image.
  - Twitter card.
- [ ] Untuk post detail:
  - title default dari post title.
  - description default dari excerpt.
  - image default dari featured image.
- [ ] Tambahkan JSON-LD `Article` atau `NewsArticle`.
- [ ] Tambahkan `datePublished`.
- [ ] Tambahkan `dateModified`.
- [ ] Tambahkan `author`.
- [ ] Tambahkan sitemap untuk post published.

Acceptance criteria:

- Source HTML post detail memiliki meta title dan description unik.
- Saat dibagikan, image dan excerpt post bisa terbaca oleh platform sosial.
- Draft tidak masuk sitemap.

## Fase 9 - Seeder dan Factory Post

Tujuan:

Data demo mendukung workflow baru.

Task:

- [ ] Update `PostFactory` agar menghasilkan status realistis:
  - mayoritas published.
  - sebagian draft.
  - sebagian scheduled.
- [ ] Pastikan published post punya `published_at <= now()`.
- [ ] Pastikan scheduled post punya `published_at > now()`.
- [ ] Pastikan setiap post punya category dan author.
- [ ] Update `PostSeeder`.
- [ ] Hindari `Post::query()->delete()` jika sudah production.
- [ ] Untuk local/demo, boleh truncate dengan guard environment.

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
