<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Coa;

$updates = [
    '1131' => 'Piutang Usaha',
    '1141' => 'Persediaan Barang Dagang',
    '1142' => 'Persediaan Bahan Habis Pakai',
    '2111' => 'Hutang Usaha',
    '2112' => 'Hutang Lain-lain',
    '4100' => 'Pendapatan Usaha',
    '4111' => 'Pendapatan Penjualan Barang',
    '4112' => 'Pendapatan Jasa',
    '4121' => 'Pendapatan Lain-lain',
    '5111' => 'Harga Pokok Penjualan (HPP)',
    '5112' => 'HPP Lain-lain',
    '6112' => 'Biaya Lembur / Tunjangan',
];

foreach ($updates as $kode => $nama) {
    Coa::where('kode_akun', $kode)->update(['nama_akun' => $nama]);
}

if (!Coa::where('kode_akun', '1151')->exists()) {
    Coa::create([
        'kode_akun' => '1151',
        'nama_akun' => 'Pajak Masukan (PPN)',
        'kategori' => 'Aktiva',
        'sub_kategori' => 'Aktiva Lancar',
        'saldo_normal' => 'Debit',
        'is_active' => 1
    ]);
}

if (!Coa::where('kode_akun', '5121')->exists()) {
    Coa::create([
        'kode_akun' => '5121',
        'nama_akun' => 'Potongan Pembelian',
        'kategori' => 'Harga Pokok Penjualan',
        'sub_kategori' => 'Harga Pokok Penjualan (HPP)',
        'saldo_normal' => 'Kredit',
        'is_active' => 1
    ]);
}

echo "COA updated to generic ERP names!\n";
