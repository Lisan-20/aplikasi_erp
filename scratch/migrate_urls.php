<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$mappings = [
    // Pendaftaran & Pencarian
    9 => '/registrasi/cari-pasien?type=poli',
    11 => '/registrasi/cari-pasien?type=igd',
    10 => '/registrasi/cari-pasien?type=pm',
    12 => '/registrasi/cari-pasien?type=ri',
    668 => '/registrasi/cari-pasien?type=igd-malam',
    807 => '/registrasi/cari-pasien?type=paket-poli',
    609 => '/registrasi/cari-pasien?type=mcu',
    13 => '/registrasi/pasien-baru',
    433 => '/registrasi/pasien-lama',
    1246 => '/registrasi/listing-poli',
    1829 => '/registrasi/permintaan-ri',
    2267 => '/registrasi/permintaan-ri',
    743 => '/registrasi/pasien-rawat-inap',
    14 => '/registrasi/edit-data',
    
    // Informasi & Jadwal
    15 => '/registrasi/jadwal-dokter',
    16 => '/registrasi/riwayat-pasien',
    28 => '/registrasi/info-ruangan',
    2349 => '/registrasi/info-ruangan-2',
    1211 => '/registrasi/harga-kamar',
    1374 => '/registrasi/info-tarif-umum',
    19 => '/registrasi/paket-bedah',
    20 => '/registrasi/paket-melahirkan',
    
    // Perjanjian & Online
    434 => '/registrasi/perjanjian-pasien',
    435 => '/registrasi/daftar-perjanjian',
    1736 => '/registrasi/listing-online',
    1737 => '/registrasi/listing-online',
    1773 => '/registrasi/listing-jkn',
    
    // Legacy mapping overlaps
    2192 => '/registrasi/listing-poli',
    
    // Admin User & Privileges
    // (Assuming User Admin is ID 528 based on previous work, or we can update by URL)
    
    // Laporan Kasir
    30 => '/laporan/kinerja',
];

$updated = 0;
foreach ($mappings as $id => $url) {
    $affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
        ->where('id_dc_sub_menu', $id)
        ->update(['url_sub_menu_baru' => $url]);
    if ($affected) $updated++;
}

// Special string-based mappings (Poli)
$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%mod_poli/antrian.php%')
    ->orWhere('url_sub_menu', 'like', '%mod_poli/antrian_pasien.php%')
    ->update(['url_sub_menu_baru' => '/poli/antrian-poli']);
$updated += $affected;

// POS Kasir Migration (Antrian Loket)
$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%antrian_loket.php%')
    ->update(['url_sub_menu_baru' => '/kasir/pos']);
$updated += $affected;

// Admin User Migration (user_view.php)
$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%user_view.php%')
    ->update(['url_sub_menu_baru' => '/admin/user']);
$updated += $affected;

// Konfigurasi Navigasi
$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%dc_modular_view.php%')
    ->update(['url_sub_menu_baru' => '/admin/modular']);
$updated += $affected;

$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%dc_modul_view.php%')
    ->update(['url_sub_menu_baru' => '/admin/modul']);
$updated += $affected;

$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%dc_menu_view.php%')
    ->update(['url_sub_menu_baru' => '/admin/menu']);
$updated += $affected;

$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%dc_sub_menu_view.php%')
    ->update(['url_sub_menu_baru' => '/admin/submenu']);
$updated += $affected;

// Privileges
$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%dd_user_group_view.php%')
    ->update(['url_sub_menu_baru' => '/admin/privileges']);
$updated += $affected;

// Gudang Penerimaan & PO
$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%po_view.php%')
    ->update(['url_sub_menu_baru' => '/pengadaan/po']);
$updated += $affected;

$affected = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('url_sub_menu', 'like', '%penerimaan_barang_view.php%')
    ->update(['url_sub_menu_baru' => '/gudang/penerimaan']);
$updated += $affected;

echo "Successfully updated $updated menu routes to url_sub_menu_baru!\n";
