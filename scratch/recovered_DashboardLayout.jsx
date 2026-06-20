The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
# Transformasi Antrian Loket Menjadi Point of Sales (POS) Generik

Melanjutkan kesepakatan kita untuk menggeser konsep *Hospital Queue* (Antrian Loket) menjadi **Sistem Kasir/POS Generik** pada ERP ini. Rencana ini juga akan mengimplementasikan logika baru terkait pemisahan `kd_tipe_brg` (1 = Barang Jadi, 2 = Jasa Layanan).

## User Review Required

> [!WARNING]  
> **Perubahan Nama URL & File**  
> Saat ini URL yang Anda sebutkan adalah `http://localhost/kasir/antrian-loket`. Demi konsistensi "ERP Generik", saya akan mengganti rute ini menjadi `/kasir/pos` atau `/kasir/utama`. Nama *Controller* juga akan diubah dari `AntrianLoketController` menjadi `PosController` (atau `KasirUtamaController`). Harap setujui perubahan *naming convention* ini.

> [!IMPORTANT]
> **Tabel Stok `mt_depo_stok_nm`**
> Pada kode *legacy*, pencarian barang dibatasi secara keras (*hard-coded*): `where('kode_bagian', '070101')`. Di ERP generik, gudang/departemen kasir mungkin dinamis. Untuk saat ini, saya akan tetap menggunakan '070101' sebagai *default depo*, namun logika stoknya akan dibuat kondisional (Jasa tidak butuh cek stok di depo ini).

## Open Questions

1. Apakah Anda setuju dengan perubahan nama *Controller* dan URL (*route*) menjadi `/kasir/pos`?
2. Pada tabel `mt_barang_nm`, apakah kolom `kd_tipe_brg` sudah pasti bernama persis seperti itu dan bertipe angka/string (1 dan 2)?

## Proposed Changes

### Backend Controllers

#### [MODIFY] [AntrianLoketController.php](file:///d:/001_Aplikasi/aplikasi_erp_laravel/app/Http/Controllers/Kasir/AntrianLoketController.php) -> `PosController.php`
- Mengganti nama *class* dan *file* menjadi `PosController`.
- **Fungsi `searchBarang`**:
  - Mengubah *Query Builder* menjadi `LEFT JOIN` ke `mt_depo_stok_nm` agar **Jasa** (yang mungkin tidak ada di tabel stok) tetap muncul di hasil pencarian.
  - Memilih kolom `kd_tipe_brg`.
- **Fungsi `checkout`**:
  - Menambahkan pengkondisian `if ($kd_tipe_brg == 1)` sebelum melakukan `stok_akhir = stok_awal - qty` dan `DB::table('tc_kartu_stok_nm')->insert(...)`.
  - Jika `kd_tipe_brg == 2`, sistem akan langsung melompat ke proses *insert* `tc_trans_kasir_detail` tanpa menyentuh tabel stok gudang.
- **Fungsi `batalTransaksi` & `returParsial`**:
  - Menerapkan kondisi yang sama: Jangan mengembalikan stok jika barang yang di-retur adalah Jasa.

#### [MODIFY] [web.php](file:///d:/001_Aplikasi/aplikasi_erp_laravel/routes/web.php)
- Mengubah rute `/kasir/antrian-loket` menjadi `/kasir/pos`.
- Memperbarui rute *API* pencarian barang, *checkout*, dan *retur* agar mengarah ke `PosController`.

### Frontend Components

#### [MODIFY] `resources/js/Pages/Kasir/AntrianLoket.jsx` -> `Kasir/Pos.jsx`
- Mengganti *interface* dari "Antrian Loket" menjadi "Point of Sales".
- Menggunakan `DashboardLayout.jsx` standar (*glassmorphism*).
- Menambahkan **Badge Visual** pada baris item di keranjang dan daftar pencarian:
  - Biru: "Barang" (Memunculkan sisa stok).
  - Hijau: "Jasa" (Menyembunyikan informasi stok).
- Memastikan logika keranjang belanja mencegah penambahan kuantitas yang melebihi batas stok **HANYA** untuk Barang (`kd_tipe_brg == 1`).

## Verification Plan

### Automated/Manual Testing
- **Test Case 1 (Barang Jadi):** Kasir mencari barang fisik -> Tambah ke keranjang melebihi stok -> UI menolak. Transaksi berhasil -> Cek `mt_depo_stok_nm` -> Stok berkurang.
- **Test Case 2 (Jasa Layanan):** Kasir mencari jasa -> UI menampilkan badge 'Jasa' -> Tambah ke keranjang kuantitas 100 -> UI mengizinkan. Transaksi berhasil -> Tidak ada error *stok minus* di *Backend*.
- **Test Case 3 (Hybrid):** Checkout 1 nota berisi 1 Barang dan 1 Jasa secara bersamaan.
