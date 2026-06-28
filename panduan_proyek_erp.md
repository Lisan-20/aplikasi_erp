# Panduan Proyek (Rulebook) Aplikasi ERP

Dokumen ini berfungsi sebagai **Ingatan Jangka Panjang (Long-Term Memory)** bagi Agen AI. Di setiap sesi percakapan baru, Agen wajib membaca dokumen ini terlebih dahulu untuk memastikan konsistensi pemahaman, arsitektur, dan konteks bisnis proyek.

---

## 1. Identitas & Konteks Bisnis
> [!IMPORTANT]
> **Konteks Utama:** Aplikasi ini adalah **Sistem ERP (Enterprise Resource Planning)** generik untuk perusahaan/bisnis, **BUKAN** Sistem Informasi Manajemen Rumah Sakit (SIMRS).

**Aturan Penamaan & Istilah Dasar:**
Dilarang keras menggunakan istilah-istilah medis pada antarmuka pengguna (UI) maupun respons diskusi, kecuali ada modul spesifik yang mengharuskannya. Gunakan pemetaan berikut:
- ❌ `Pasien` ➔ ✅ `Pelanggan` / `Klien`
- ❌ `No. RM (Rekam Medis)` ➔ ✅ `ID Pelanggan`
- ❌ `Poli / Poliklinik` ➔ ✅ `Departemen` / `Divisi` / `Outlet`
- ❌ `Dokter / Perawat` ➔ ✅ `Staf` / `PIC` / `Sales`
- ❌ `Rumah Sakit / RS Fikri Medika` ➔ ✅ `Perusahaan` / `Sistem ERP`
- ❌ `Registrasi Pasien` ➔ ✅ `Pendaftaran Klien` / `Reservasi`

**Path & Identitas Sistem:**
- Folder *root* proyek lokal adalah `aplikasi_erp_laravel`.
- Konteks URL dan *routing* aplikasi lama (*Legacy*) menggunakan `/aplikasi_erp/...`.
- Container Docker menggunakan nama `aplikasi_erp_app`, `aplikasi_erp_nginx`, `aplikasi_erp_redis`.

---

## 2. Standar Visual & UI/UX (Tailwind CSS)
> [!IMPORTANT]
> **MIGRASI TAILWIND CSS:** Proyek ini **SEKARANG DAN SELAMANYA MENGGUNAKAN Tailwind CSS** sebagai satu-satunya standar penulisan *style* utama. Selalu gunakan *utility classes* bawaan Tailwind (`bg-white`, `p-6`, `flex`, `dark:bg-slate-800`, dll) untuk merender seluruh UI baru. Penulisan CSS khusus (*custom CSS* di `app.css` atau *inline style*) sangat dilarang kecuali sangat terpaksa. Kelas *legacy* lama seperti `glass-panel` tetap dapat digunakan karena sudah didefinisikan ulang secara internal menggunakan `@apply` atau dibiarkan agar tidak merusak halaman lawas, namun utamakan *utility class* murni dari Tailwind untuk semua fitur dan halaman baru tanpa kecuali.

Seluruh komponen UI harus mengikuti panduan estetika *Glassmorphism* yang terlihat futuristik dan mewah:
- **Layout Halaman Standar (Index):** WAJIB menggunakan struktur pembungkus `<div className="pl-container">`. Di dalamnya, bagi menjadi dua area utama:
  1. `<div className="pl-header glass-panel">` untuk judul (`pl-title`) dan tombol aksi (`pl-actions`).
  2. `<div className="glass-panel table-wrap">` sebagai kontainer tabel utama dan kolom pencarian.
- **Tabel Data:** WAJIB dibungkus dengan *wrapper* `div` yang memiliki kelas bawaan Tailwind **`overflow-x-auto w-full`** agar tabel bisa di-*scroll* menyamping di layar kecil tanpa merusak *layout* utama. Di dalamnya, gunakan `<table className="pl-table">` (jika masih menggunakan *class* lama `table-responsive`, wajib digabung menjadi `<div className="overflow-x-auto w-full table-responsive">`). Alternatif kelas tabel *legacy* adalah `premium-table` atau `dash-table`, tetapi *wrapper scroll* Tailwind ini MUTLAK wajib ada di semua halaman *listing*.
- **Search Header:** Gunakan kombinasi `<div className="search-bar">` dan `<div className="search-input-wrapper">` dipasangkan dengan input `<input className="search-input">` yang diletakkan di dalam `table-wrap`. Pastikan state `searchTerm` menggunakan *debounce*, dengan logika penangkal *bug reset*: `if (searchTerm !== (filters?.search || ''))`. Jangan gunakan perbandingan yang tidak stabil dengan `undefined` karena dapat mereset URL (dan menghilangkan paginasi) saat berpindah halaman.
- **Form & Input Component:** **DILARANG KERAS** menggunakan *inline styling* dengan warna statis, dan **DILARANG** menggunakan kelas bawaan lama seperti `form-control` pada *input*, *select*, atau modal, karena kelas lama tersebut akan merusak kontras *Dark Mode*. Sebagai gantinya, WAJIB menggunakan kelas **`premium-input`** yang sudah didefinisikan secara khusus di `app.css` untuk menangani latar belakang transparan dan kontras font putih secara sempurna.
- **Library Eksternal (contoh: react-select):** Wajib menimpa (*override*) konfigurasi gaya (*styles*) bawaannya dengan memasukkan warna *solid* khusus mode gelap (seperti `#1f2937` untuk *dropdown menu* dan teks putih `#fff`) agar daftar opsi yang dihasilkan memiliki lapisan belakang tebal dan tidak menimpa tulisan di bawahnya (*unreadable transparent overlap*).
- **Tombol Aksi (Buttons):** WAJIB menggunakan kelas turunan `.dash-btn` (seperti `className="dash-btn primary"`, `secondary`, atau `danger`) dan `.dash-icon-btn` yang telah didefinisikan secara global melalui arahan `@apply` Tailwind di `app.css`. DILARANG KERAS membuat tombol tanpa kelas (yang akan menjadi teks polos bawaan Tailwind) atau menggunakan *inline styling* manual.
- **Dinamis Font & Warna (Tailwind Dark Mode):** JANGAN MENYEMATKAN kelas pewarnaan statis (seperti `text-white` atau `bg-slate-900` saja) pada halaman khusus yang tidak di-*wrap* oleh Layout. Selalu kombinasikan kelas warna standar dengan *modifier* `dark:` dari Tailwind (contoh: `text-slate-900 dark:text-white`, `bg-slate-50 dark:bg-slate-900`, `group-hover:text-blue-600 dark:group-hover:text-white`) agar elemen selalu kontras dan terbaca jelas pada kedua tema.
- **Sinkronisasi Tema (FOUC Prevention):** Sistem mengatur kelas `.dark` dan `data-theme` secara otomatis lewat inisialisasi di `<head>` pada `app.blade.php`. Pastikan modifikasi *Layout* (contoh: `DashboardLayout.jsx`) turut merubah `document.documentElement.classList.add/remove('dark')` agar fungsi Tailwind mode bekerja sinkron di seluruh komponen.
- **Micro-animations:** Semua tombol (`btn-primary`, `btn-secondary`) dan baris tabel harus memiliki transisi warna/hover yang lembut.
- **Paginasi & Penomoran Baris:** Penomoran baris pada tabel *wajib* menggunakan rumus `{(data.current_page - 1) * data.per_page + index + 1}` agar nomor urut berlanjut di halaman berikutnya. Paginasi WAJIB diletakkan **DI LUAR** `<div className="glass-panel table-wrap">` (yakni tepat di bawahnya, sebagai *child* langsung dari `pl-container`). Gunakan struktur `<div className="pagination">` yang berisikan tombol-tombol `<Link className="page-link active">` dan `<span className="page-link disabled">`.
- **Form Laporan (Report UI):** **JANGAN** membuat laporan yang memuat (kueri) seluruh data tabel secara otomatis di layar utama saat halaman baru dibuka (hal ini memberatkan server). Gunakan pola *Filter Form* (Pilih Tanggal, Pilih Shift, Pilih User) dengan *sidebar* minimalis, lalu sediakan tombol **Cetak Laporan** atau **Export Excel/CSV** di-*freeze* (disematkan) pada bagian *footer*.
- **Tabel Transaksional:** Untuk tabel dengan banyak kolom atau data, *wrap* tabel di dalam `<div className="table-responsive">` dan gunakan *sticky header* atau *frozen footer* (seperti yang dilakukan pada Modul Kasir).

---

## 3. Technology Stack & Eksekusi Koding
- **Frontend:** React (JSX) yang diintegrasikan melalui **Inertia.js** dan di-*build* menggunakan **Vite** (`npm run build`).
- **Backend:** Laravel (PHP). Di lingkungan *production* atau lokal tingkat lanjut, aplikasi ini berjalan menggunakan **Laravel Octane (Swoole)**. Server dijalankan via Docker (`docker-compose`).
- **Pembaruan UI:** Setiap kali Agen AI melakukan modifikasi pada *file* `.jsx`, Agen **wajib** menjalankan perintah `npm run build` di *background* agar perubahan terlihat oleh pengguna.
- **Pembaruan Backend:** Setiap kali Agen AI melakukan modifikasi pada logika Laravel (Controller, Route, dll), Agen **wajib** menjalankan perintah `docker exec aplikasi_erp_app php artisan octane:reload` agar perubahan kode terdeteksi oleh server Octane di dalam kontainer Docker.

---

## 4. Aturan Database & Query (SQL Server)
> [!WARNING]
> Proyek ini menggunakan **Microsoft SQL Server (ODBC Driver 17)**. Perhatikan baik-baik pembatasan dan karakteristik *query* agar tidak terjadi *timeout* atau *Syntax Error*.

- **Penanganan Timeout:** Setiap kueri laporan yang membaca tabel transaksional besar **wajib** menyertakan filter rentang waktu (`tgl_awal` dan `tgl_akhir`). Dilarang melakukan *query* `SELECT *` tanpa filter waktu atau `LIMIT/TAKE`.
- **Sensitivitas Kolom (Case & Naming):** 
  - Pada tabel `dd_user`, kolom nama pengguna adalah `nama_lengkap` atau `username` (BUKAN `nama_user`).
  - Pencarian string di SQL Server bawaan mungkin *case-sensitive* (bergantung pengaturan *Collation* seperti `Latin1_General_CS_AS`).
- **Eksekusi Stored Procedure (Multi-Result Set):** Saat mengeksekusi SP kompleks yang mengembalikan lebih dari satu tabel (*multiple SELECTs*), **DILARANG** menggunakan Eloquent Builder biasa. WAJIB menggunakan objek PDO murni milik Laravel (`DB::connection()->getPdo()`) dikombinasikan dengan `$stmt->nextRowset()` untuk melompat antar tabel (*result set*). Hal ini sangat penting untuk pelaporan/dashboard dengan efisiensi tinggi (menarik banyak data dengan 1 kali koneksi *network*).

## 5. Konvensi Penamaan (Naming Conventions)
- **Session Key:** WAJIB menggunakan ejaan bahasa Indonesia/lokal yang sudah ada untuk menjaga kompatibilitas dengan Middleware lama. Contoh: gunakan `Session::put('active_modul', ...)` (tanpa huruf 'e'), **BUKAN** `active_module`. Begitu pula dengan `id_dd_user`, `id_dc_modul`, dsb.
- **File Legacy:** File `.php` dari CodeIgniter/Native tidak boleh dihapus sampai seluruh halamannya selesai di-*rewrite* ke React Inertia.
- **Routing:** Gunakan penamaan rute bergaya *dot notation* (misal: `admin.user.index`).

---

## Cara Menggunakan Dokumen Ini di Sesi Baru
Setiap kali Pengguna memulai jendela obrolan (*chat*) yang benar-benar baru dan kosong, Pengguna cukup mengetik:
`"Tolong baca panduan_proyek_erp.md sebelum mulai bekerja."`
Maka Agen AI akan memuat dokumen ini dan langsung memiliki ingatan yang seragam.

---

## 6. Ringkasan Eksekusi Antigravity (Master Changelog)
> [!NOTE]
> Daftar ini merupakan rangkuman (summary) dari seluruh pencapaian, perombakan, dan penambahan fitur yang telah diselesaikan oleh Agen AI (Antigravity) sejak awal proyek hingga saat ini.

### Tahap 1: Rebranding & Fondasi Sistem Baru
- **Transisi Sistem (SIMRS ➔ ERP):** Mengubah seluruh identitas aplikasi dari basis "Sistem Informasi Rumah Sakit" (`aplikasi_rs_laravel`) menjadi **Sistem ERP Generik** (`aplikasi_erp_laravel`).
- **Pembersihan Istilah:** Menghilangkan seluruh jejak penamaan medis di UI/UX (seperti mengganti "Pasien" menjadi "Pelanggan/Klien", "Poli" menjadi "Outlet", dsb).
- **Pembaruan Lingkungan:** Menyesuaikan *path* komponen *React*, nama kontainer Docker (`aplikasi_erp_app`), serta konfigurasi NPM (`package.json`) dan Vite agar selaras dengan nama proyek baru.

### Tahap 2: Modernisasi & Desain Premium (Glassmorphism)
- **Refactoring UI/UX:** Bermigrasi dari antarmuka Native/Legacy ke *Single Page Application* berbasis React.js dan Inertia.js.
- **Glassmorphism:** Mengimplementasikan tema premium berbasis latar transparan bergaya kaca (Glass), *dark mode*, serta kontrol UI modern yang bersih dan futuristik.

### Tahap 3: Pembaruan Modul Admin & Keamanan
- **Admin User Management:** Menulis ulang antarmuka manajemen pengguna (`dd_user`) menggunakan React.
- **Asynchronous Search Dropdown:** Mengimplementasikan elemen *Select2/Async* modern (pencarian langsung dari *database*) tanpa mengorbankan keamanan sistem lama (tetap mendukung enkripsi algoritma MD5 warisan).

### Tahap 4: Sistem Point of Sales (POS) & Kasir Terpadu
- **Desain Layar Kasir:** Membuat panel kasir interaktif dengan tata letak *Split-view* (Daftar Barang vs Keranjang).
- **Live Search & Pagination:** Meniadakan kewajiban tombol "Enter" dengan sistem *Debounce* pada pencarian barang, serta menggunakan `.paginate(30)` untuk mengontrol performa RAM server saat memuat jutaan data inventaris.
- **Retur Parsial:** Melengkapi sistem kasir dengan algoritma yang mengizinkan pembatalan/pengembalian (*retur*) sebagian barang dan memastikan stok gudang dikalkulasi secara presisi.
- **Cetak Struk:** Menambahkan fitur cetak struk termal mini yang rapi (`StrukKasir.jsx`).

### Tahap 5: Modul Laporan Transaksi Kasir
- **Form Filter Sidebar:** Meningkatkan kecepatan muat (loading) halaman laporan secara signifikan dengan membuang pola *Auto-load Table*. Laporan sekarang menggunakan *Sidebar Filter* sebelum memuat kueri.
- **Export & Print:** Menambahkan fungsionalitas tombol **Export Excel (CSV)** dan pencetakan riwayat pembayaran (*Print-friendly view*) lengkap dengan kalkulasi jumlah "Uang Diterima" dan "Kembalian".

### Tahap 6: Integrasi Kecerdasan Buatan (AI Agnostic)
- **Ollama & Gemini:** Membekali Kasir dengan Asisten AI pintar yang bisa memberikan saran/rekomendasi otomatis berdasarkan input. Mendukung sistem *Agnostic* di mana *user* bisa beralih dari API Cloud (Google Gemini) ke AI Lokal (Ollama) lewat berkas `.env`.
- **Fuzzy Search & Parser:** Memperkuat AI dengan sistem *RegEx* canggih untuk membersihkan sampah *Markdown Tag* dari respons LLM, serta menanamkan sistem *Fuzzy Search* (`LIKE '%KATA%'`) agar barang tetap ditemukan meski AI mengalami kesalahan kecil pada pengejaan nama barang.

### Tahap 7: Optimasi Responsif Mobile (UI/UX)
- Menangani *bug* layar hitam saat mengakses aplikasi dari HP (*Mobile Web*).
- Menata ulang komponen *DashboardLayout* agar *Sidebar Menu* dan halaman Kasir bisa berinteraksi secara mulus (bebas digulir) dengan tinggi yang dinamis di ukuran layar kecil.

### Tahap 8: Eksperimen Arsitektur Microservices & REST API
- **Node.js API Server:** Membuat proyek eksperimental `erp_node_api` berbasis Express.js yang berjalan di port 3000 sebagai peladen (server) REST API mandiri (Microservice).
- **Direct Database Connectivity:** Menghubungkan Node.js langsung ke SQL Server (`mssql`) secara terpisah dari *backend* utama Laravel.
- **Client-Side Fetching (React):** Membangun antarmuka eksperimen `/belajar-api` pada React untuk melakukan ekstraksi data asinkron (*asynchronous fetch*) langsung ke Node.js, mem-Bypass struktur Inertia.js untuk keperluan pemahaman komunikasi REST murni.

### Tahap 9: Perombakan Struktur Odoo ("Sihir Odoo") & High-Performance Dashboard
- **Pemisahan Layout Tegas (Form View vs List View):** Mengadaptasi standarisasi antarmuka bergaya Odoo ERP.
  - **Form Views:** Halaman entri atau rincian dokumen tunggal (seperti `PendaftaranRi`, `RawatJalan`) dibungkus menggunakan antarmuka Kertas Putih (`odoo-document-sheet`) di tengah, dan Panel Riwayat/Log (`odoo-chatter`) di sisi kanan.
  - **List Views:** Halaman yang memuat tabel master/pencarian data massal (seperti `ListingPoli`, `DaftarPerjanjian`) dioptimalkan menggunakan tata letak *Full Width* tanpa *chatter*, dengan sistem *grid overflow* agar tampilan layar digunakan sepenuhnya oleh tabel.
- **Data Riil via Stored Procedure (SP):** Mengganti data statis/dummy di Dashboard Kasir dengan data riil tanpa mengorbankan kecepatan. Seluruh kalkulasi metrik berat (Tren Pendapatan Harian, Akumulasi Piutang, Distribusi Metode Pembayaran) kini dikerjakan secara super-cepat di *Database Engine* melalui `sp_DashboardKasir_GetMetrics` dan disalurkan ke React (Recharts) via API Controller tunggal.
- **Perbaikan Bug JSX:** Memastikan integritas HTML/JSX tertutup rapi setelah perombakan massal struktur div (`npm run build` sukses).

### Tahap 10: Dokumentasi Arsitektur Lanjutan & Sesi Troubleshooting AI
- **Pembuatan Panduan Arsitektur Murni:** Menulis dan men-generate dokumen `Panduan_Alur_Kerja_ERP.doc` yang berisi bedah kodingan dan aliran data (Routing -> Controller -> JSX) baik menggunakan pola *Inertia props* maupun pola *Asynchronous Fetching (AJAX)*.
- **Konsep Keamanan AJAX & Axios:** Mendefinisikan secara tegas dalam *Rulebook* bahwa AJAX/Frontend DILARANG memuat kueri SQL mentah untuk mencegah celah peretasan. Seluruh kueri wajib dieksekusi di ranah Backend (Laravel Controller).
- **Troubleshooting Laravel Octane (State Bleed):** Mengarsipkan pengetahuan krusial terkait "Memory Leak" di mana penggunaan variabel `static` atau data *Singleton* yang terkait dengan spesifik *User* akan menyebabkan data tertukar antar-pengguna karena siklus PHP yang tidak pernah mati di ekosistem Swoole.
- **Kasus Sensitivitas OS (Windows vs Linux):** Mendiagnosis *blank screen* pada React saat tahap `npm run build` di Docker/Linux yang diakibatkan oleh perbedaan perlakuan huruf besar-kecil pada jalur *import file* di Windows (sistem pengembang) dan Linux (server produksi).
- **Mencegah Memory Exhaustion:** Melarang penggunaan metode `.get()` secara vulgar pada tabel raksasa (jutaan baris) untuk fitur seperti *Export Excel*. Wajib diganti dengan pendekatan mencicil menggunakan metode `.chunk()`, `.cursor()`, atau melalui pekerjaan layar belakang (*Background Queue Jobs*).

### Tahap 11: Pemahaman Arsitektur REST API & Komparasi Sistem Legacy
- **Analisis Komparatif:** Membedah arsitektur aplikasi lama (`aplikasi_erp`) yang murni menggunakan *Native PHP*, *ADODB*, dan *jQuery AJAX* tanpa *framework* modern, untuk membandingkannya dengan aplikasi baru yang berbasis *Laravel + React (Inertia.js)*.
- **Konsep Modern Monolith (Inertia.js):** Menegaskan bahwa aplikasi baru adalah sistem *Hybrid*. Alih-alih membuat *full* REST API untuk setiap perpindahan halaman, aplikasi menggunakan **Inertia.js** (Server-driven SPA) untuk data inti, dan hanya menggunakan **REST API (Axios/Fetch)** untuk komponen yang butuh kecepatan asinkron (seperti *Live Search* dan AI).
- **Standar Pengambilan Keputusan Kueri (Axios vs Fetch):** Mendokumentasikan alasan penggunaan *Fetch API* (bawaan *browser* ringan) untuk *GET Request* sederhana, dan penggunaan **Axios** untuk *POST Request* berat (seperti mengirim objek Keranjang Belanja), karena Axios otomatis menangani konversi JSON dan penyisipan *CSRF Token* Laravel untuk keamanan.
- **Standarisasi Metode HTTP (GET vs POST):** Menegaskan aturan penggunaan metode HTTP: Metode **GET** dilarang digunakan jika mengirim kumpulan data besar (seperti isi array *cart*) karena batasan panjang URL. Metode **POST** diwajibkan untuk pengiriman data berstruktur (JSON) agar aman dari *log server* dan tidak memutus koneksi.
- **Saklar AI Agnostik (Agnostic AI Provider):** Mencatat teknik *Design Pattern* menggunakan *Environment Variable* (`.env`) untuk memindahkan eksekusi logika (*switch*) dari Google Gemini ke Ollama Local AI secara instan tanpa perlu membongkar atau *hardcode* berkas `AiController.php`.

### Tahap 12: Manajemen Routing & Resolusi Konflik CSS Global
- **Aturan Ketat Penambahan Routing (Anti-Overwrite):** Menetapkan SOP baru bahwa penambahan menu atau rute baru di `routes/web.php` DILARANG KERAS menimpa (*overwrite*) blok fungsi `Route::prefix` yang sudah ada (misalnya menggunakan fungsi pencarian dan penggantian yang ceroboh). Penambahan rute harus selalu di-*append* (disisipkan) di dalam grup yang relevan, atau membuat grup baru untuk menghindari hilangnya ratusan *endpoint* lain secara fatal yang dapat menyebabkan gagalnya `php artisan octane:reload`.
- **Penanganan CSS Leak (Kebocoran CSS Global):** Mendokumentasikan insiden "CSS Leak" di mana *file* CSS bawaan halaman lama (seperti `pasien-lama.css`) mendefinisikan ulang *class* global bergaya generik seperti `.glass-panel` atau `body`, yang secara tidak sengaja merusak struktur utama `DashboardLayout.jsx`.
- **Isolasi Namespace CSS (Scoping):** Mewajibkan penggunaan nama *class* yang unik dan ber-awalan spesifik (seperti `.dash-glass-panel` alih-alih `.glass-panel`) pada komponen *layout* utama (Root Layout) untuk melindunginya dari modifikasi CSS sub-halaman yang ditarik via rute Inertia.
- **Kewajiban Rebuild Frontend (Vite):** Mengingatkan bahwa di lingkungan *production* atau saat tidak menjalankan `npm run dev`, segala bentuk perubahan pada kode React (`.jsx`) atau *Layout* tidak akan terefleksikan di *browser* meskipun *server backend* (Laravel Octane) sudah di-restart. Perintah `npm run build` MUTLAK harus dieksekusi agar aset-aset statis (JS/CSS) terbaru dikompilasi ulang oleh Vite ke dalam folder `public/build/assets/`.

### Tahap 13: Migrasi Tailwind CSS, Estetika ERP Premium & Responsivitas Mobile
- **Kompatibilitas Versi Tailwind (v3 vs v4):** Menemukan dan mengatasi konflik di mana Vite pada Laravel gagal mem-parsing utilitas CSS secara penuh saat dipaksa menggunakan Tailwind v4 (`@tailwindcss/vite`). Menetapkan aturan baku untuk **TETAP MENGGUNAKAN Tailwind CSS v3 (`^3.4.1`)** beserta *plugin* PostCSS konvensional di proyek ini guna menjamin stabilitas integrasi kelas.
- **Peningkatan Estetika (Premium ERP Look):** Mengakhiri ketergantungan pada *inline styles* rumit dengan sepenuhnya beralih ke *utility class* Tailwind untuk menghidupkan *Dashboard* interaktif. Pembaruan mencakup *glassmorphism* tingkat lanjut (`bg-slate-800/80 backdrop-blur-xl border border-slate-700/60`), iluminasi latar dinamis (`blur-3xl`), dan ikon vektor dari *Lucide React*.
- **Optimasi Mobile & Responsivitas:**
  - **Auto-collapse Sidebar:** Menerapkan deteksi jendela proaktif (`window.innerWidth > 768`) di mana *Sidebar* (menu kiri) otomatis dalam mode tertutup saat diakses lewat layar HP untuk memprioritaskan ruang konten.
  - **Wraparound Actions:** Menyematkan `flex-wrap` pada deretan tombol agar baris tak terpotong (*overflow*) pada layar sempit.
  - **Horizontal Scroll Table:** Mewajibkan penyematan `<div className="overflow-x-auto">` untuk membungkus tabel data transaksional agar mencegah *layout breaking* saat dibuka di ponsel.

### Tahap 14: Migrasi Tata Letak Navigasi (Odoo-style Top Nav)
- **Top Horizontal Navigation:** Meniadakan Sidebar secara permanen dari layar desktop utama untuk memaksimalkan lebar layar demi tabel data yang ekstensif (100% width). Memindahkan seluruh menu utama ke deretan mendatar (horizontal) di bawah header, meniru tata letak Odoo 17.
- **Dropdown Clipping (CSS Overflows):** Mendokumentasikan aturan CSS absolut terkait Menu Dropdown: **Dilarang keras menggunakan `overflow-x: auto`** pada kontainer induk (parent) jika di dalamnya terdapat elemen `position: absolute` (seperti dropdown melayang) yang ditujukan untuk melampaui batas tinggi kontainer. Hal ini akan menyebabkan menu dropdown terpotong (*clipped* / *invisible*). Solusinya adalah menghapus `overflow-x: auto` dan menggunakan fitur pembungkus otomatis (`flex-wrap: wrap`).

### Tahap 15: Rebranding Global Dokumen (README.md)
- **Migrasi Identitas:** Secara resmi mengubah seluruh referensi 'SIMRS (Sistem Informasi Manajemen Rumah Sakit)' pada berkas utama `README.md` menjadi 'Sistem ERP (Enterprise Resource Planning)'.
- **Generalisasi Istilah:** Mengonversi istilah operasional medis menjadi istilah bisnis generik (misal: 'Patient Registration' menjadi 'Customer & Client Management', 'Poli/IGD' menjadi 'Departmental Operations', 'Farmasi' menjadi 'Inventory & POS').
- **Dokumentasi Arsitektur Hibrida:** Menambahkan penjabaran secara resmi bahwa aplikasi merupakan 'Hybrid SPA' yang tidak sekadar mengandalkan Inertia.js untuk render UI, melainkan turut menggunakan *Fetch API/Axios* secara terisolasi untuk fitur super-cepat yang bersifat asinkron (misal: Live Search & AI).
- **Tata Letak Odoo:** Meresmikan pola tata letak UI yang memisahkan *List Views* (Full Width Grid) dengan *Form Views* (Document Sheet + Chatter).

### Tahap 16: Quality Control, Code Formatting, & Konfigurasi Waktu
- **Linting & Formatting:** Melakukan pembersihan dan perapian kode massal menggunakan Laravel Pint (untuk Backend PHP) dan ESLint Fix (untuk Frontend React). Standar kodingan saat ini mengikuti *Clean Code* bawaan *framework* secara ketat.
- **Konfigurasi Zona Waktu:** Mengubah `timezone` default di `config/app.php` dari `UTC` menjadi `Asia/Jakarta` (WIB, +07:00) agar aktivitas log dan waktu aplikasi selaras dengan waktu PC lokal.

### Tahap 17: Modul Master Barang & Stok Opname Gudang
- **Master Barang (`mt_barang_jasa`):** Membuat tabel baru untuk mendata inventaris tanpa imbuhan `_nm` (non-medis) agar generik untuk ERP. Mengatasi kendala ketiadaan *auto-increment* (IDENTITY) pada SQL Server dengan algoritma kalkulasi `Max(id_barang) + 1` langsung di PHP.
- **Pemisahan Entitas Gudang (`mt_depo_stok_brg_jasa`):** Menetapkan bahwa jumlah fisik barang tidak disimpan di tabel Master, melainkan dipecah per-Gudang (Depo) dengan *identifier* khusus (contoh: Gudang Utama = `070101`).
- **Perekaman Jejak Audit (Kartu Stok):** Seluruh pergerakan barang (Penerimaan, Kasir Keluar, Retur, maupun Stok Opname) wajib terekam secara komprehensif ke `tc_kartu_stok_brg_jasa`. Rekaman ini mencakup stok awal, mutasi masuk/keluar, stok akhir, ID petugas (`id_dd_user`), jenis transaksi (1=Penerimaan, 4=Opname, 6=Penjualan, 7=Retur), dan Keterangan historisnya.
- **Stok Opname Dinamis:** Membangun antarmuka interaktif `StokGudang/Index.jsx` yang memfasilitasi Staf Gudang untuk mengubah secara presisi stok fisik terkini via *Pop-up*, dengan *backend* yang secara cerdas menghitung otomatis apakah terjadi defisit (Pengeluaran) atau surplus (Pemasukan) untuk dicatat ke dalam Kartu Stok.
- **Standar Filter Status Aktif:** Menyembunyikan item yang telah "dihapus lembut" (`status = 0`) dari *List View* stok operasional agar tidak mengotori layar pengguna saat mengelola barang aktif.
- **Koreksi Pendapatan Retur (Laporan Kasir):** Menyempurnakan logika `PosController` agar pada saat terjadi **Retur Parsial**, nominal Tunai/Debet/Kredit turut berkurang secara proporsional dari total `bill`, sehingga Laporan Kasir tidak mengalami inflasi (membaca nominal tagihan aslinya) pasca pengembalian sebagian barang.

### Tahap 18: Modul Master Bagian & Master Karyawan (HRD Dasar)
- **Master Bagian (Departemen):** Membersihkan tabel `mt_bagian` dari kolom-kolom berbau fungsionalitas medis (seperti tarif spesialis dan parameter poliklinik) untuk menjadikannya tabel departemen perusahaan generik. Membangun halaman antarmuka `admin/bagian` yang rapi.
- **Master Karyawan (Data Pegawai):** Melakukan perombakan tabel `mt_karyawan` secara masif dengan menjatuhkan (_drop_) 12 kolom warisan rumah sakit (STR, SIP, DPJP, Kode Dokter) dan mempertahankan kolom administratif. Modul karyawan dipisah secara khusus ke rute `hrd/data-pegawai` dengan form data diri interaktif berbasis Modal.
- **Global Flash Message Notification:** Memperbaiki insiden kurangnya _feedback_ visual (contoh: saat menghapus modul) dengan menarik _props_ `flash` dari middleware `HandleInertiaRequests.php` secara terpusat di `DashboardLayout.jsx`, menggunakan `useEffect` untuk merender Notifikasi _SweetAlert2_ pada seluruh aksi CRUD di seluruh aplikasi.
- **Alamat Wilayah Berjenjang (Cascading Dropdown):** Menyempurnakan form pegawai dengan menambahkan pemilihan wilayah secara *live* dari API terpusat (Provinsi ➔ Kota ➔ Kecamatan ➔ Kelurahan), beserta migrasi tipe data di SQL Server untuk menangani bentrokan tipe `INT` menjadi `VARCHAR`. Menambahkan *Tabs* filter status (Aktif/Nonaktif) untuk memudahkan manajemen *listing* data.
- **Perbaikan Dependensi Tampilan (*Views*):** Mengidentifikasi dan memperbarui definisi *View* usang di SQL Server (`user_karyawan_v`) yang ikut terimbas (mengalami *error Invalid column*) saat penghapusan kolom-kolom medis di `mt_karyawan`.

### Tahap 19: Perencanaan & Gap Analysis Standar ERP
- Melakukan riset komprehensif terhadap fitur standar *Enterprise Resource Planning* modern (Keuangan, Rantai Pasok/Pembelian, Gudang, CRM, SDM).
- **Analisa Kesenjangan (Gap Analysis):** Menyimpulkan bahwa sistem ERP yang sedang dibangun telah kuat secara teknologi dan matang pada modul Kasir (POS), Gudang Dasar, Manajemen Akses, dan Data Induk SDM. Namun, sistem masih memiliki celah fungsional di area Keuangan (GL, Hutang/Piutang) dan Rantai Pasok (Pembuatan PO hingga Penerimaan Barang).
- **Penetapan Prioritas Berikutnya:** Disepakati untuk berfokus pada Modul Pengadaan (*Procurement*) yang meliputi sistem pembuatan *Purchase Order* (PO) dan *Goods Receipt* (Penerimaan Barang). Pembuatan siklus pembelian ini sangat krusial agar persediaan fisik gudang dapat diotomatisasi secara *end-to-end* (menutup siklus mutasi gudang).

### Tahap 20: Siklus Rantai Pasok (Purchase Order, Penerimaan, & Retur)
- **Purchase Order (PO) & Permintaan Pembelian (PR):** Mengimplementasikan alur pengadaan barang mulai dari pengajuan spesifikasi barang (PR) hingga disetujui menjadi Pesanan Pembelian (PO). Tabel master `tc_po` dan `tc_po_det` direstrukturisasi, di mana ID tabel tidak *auto-increment* sehingga disematkan logika pencarian nilai *max ID* melalui Laravel Controller.
- **Penerimaan Barang (Goods Receipt / LPB):** Merancang antarmuka penerimaan gudang yang terhubung langsung dengan sisa kuantitas PO yang belum dikirim. Secara teknis, proses ini tidak hanya membuat dokumen penerimaan (`tc_penerimaan_barang_nm`), tetapi juga langsung berimbas ganda:
  - **Efek Persediaan:** Menambah stok fisik gudang (`mt_depo_stok_brg_jasa`) dengan kode bagian spesifik (`070101`) dan merekam histori pada Kartu Stok Gudang.
  - **Efek Finansial:** Menerbitkan dokumen **Hutang Usaha (Account Payable)** secara instan ke tabel `transaksi_hutang` saat barang fisik dikonfirmasi mendarat.
- **Retur ke Supplier (Purchase Return):** Melengkapi siklus pembelian dengan fitur Retur Parsial/Keseluruhan. Sistem cerdas melacak barang yang sudah masuk dan mengizinkan pengembalian sebagian jika ada barang *reject/cacat*. Retur ini kembali berimbas ganda secara mulus:
  - **Efek Persediaan:** Memotong kembali stok di gudang dan merekamnya sebagai pengeluaran/retur pada Kartu Stok.
  - **Efek Finansial (Credit Note):** Menerbitkan jurnal minus otomatis ke `transaksi_hutang` agar total hutang perusahaan ke *supplier* ikut terpotong sejumlah nilai barang yang dikembalikan.
- **Agenda Modul Gudang Lanjutan:** Disepakati bahwa sebelum menginjak Modul Finansial & Akuntansi Inti, sistem harus terlebih dahulu diperkuat dengan fitur *Internal Issue* (Distribusi Barang Antar Unit), Stok Opname Terpusat, dan Laporan Saldo Persediaan Gudang (sebagai dasar kalkulasi *Cost of Goods Sold* atau HPP).

### Tahap 21: Modul Gudang Lanjutan (Stok Opname, Laporan, & Pengeluaran Internal)
- **Stok Opname (Audit Inventaris):** Menyempurnakan fungsionalitas Stok Opname Gudang (Penyesuaian Stok Fisik). Memperbaiki *bug* kalkulasi selisih stok (konversi tipe data antara nvarchar dan int) saat barang disesuaikan. Memastikan rekaman tersimpan sempurna di Kartu Stok (`jenis_transaksi = 4`).
- **Laporan Stok Gudang (Inventory Balance):** Membangun layar Laporan Stok komprehensif yang bisa difilter berdasarkan bulan, tahun, dan *Search Term* barang. Menyertakan kapabilitas Cetak PDF (*Print View*) dan Ekspor ke format CSV yang rapi saat dibuka di Microsoft Excel. Laporan ini menjadi pondasi dasar penilaian persediaan (Inventory Valuation).
- **Pengeluaran Internal (Transfer Antar-Unit):** Mengimplementasikan fitur *Internal Issue* atau pengiriman barang dari Gudang Utama (`070101`) ke bagian/unit lain di dalam perusahaan.
  - **Efek Ganda Persediaan:** Mutasi ini memotong stok dari Bagian Asal (Gudang Utama) dengan mencatat rekaman `jenis_transaksi = 8` (Pengeluaran Internal), sekaligus menambah stok di Bagian Tujuan dengan mencatat `jenis_transaksi = 9` (Penerimaan Internal).
  - Jika barang belum pernah ada di unit tujuan, sistem otomatis membuatkan baris *stok* baru untuk unit tersebut.
  - **Detail Riwayat Transaksi:** Menyediakan Modal Detail Riwayat (Pop-up) untuk melacak Nomor Dokumen, Petugas Pengirim, dan rincian item beserta kuantitasnya secara rinci tanpa perlu berpindah halaman.
- **Kesiapan Modul Keuangan:** Setelah siklus logistik dan pergudangan tuntas, sistem resmi dinyatakan siap untuk transisi ke rancang bangun **Modul Akuntansi, Manajemen, dan Keuangan** (General Ledger, Chart of Accounts, Journal Entries).
