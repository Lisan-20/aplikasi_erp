<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Coa;

$coas = [
    ['kode_akun' => '1100', 'nama_akun' => 'Aktiva Lancar', 'tipe_akun' => 'K', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1111', 'nama_akun' => 'Kas Kecil (Petty Cash)', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1112', 'nama_akun' => 'Kas Besar', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1121', 'nama_akun' => 'Bank BCA (Operasional)', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1131', 'nama_akun' => 'Piutang Pasien Umum', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1141', 'nama_akun' => 'Persediaan Obat & Farmasi', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1142', 'nama_akun' => 'Persediaan Barang Medis (BHP)', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    
    ['kode_akun' => '1200', 'nama_akun' => 'Aktiva Tetap', 'tipe_akun' => 'K', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1211', 'nama_akun' => 'Tanah & Bangunan', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '1212', 'nama_akun' => 'Peralatan Medis', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],

    ['kode_akun' => '2100', 'nama_akun' => 'Hutang Jangka Pendek', 'tipe_akun' => 'K', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '2111', 'nama_akun' => 'Hutang Dagang (Supplier Obat/BHP)', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '2112', 'nama_akun' => 'Hutang Jasa Dokter', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '2131', 'nama_akun' => 'Hutang Pajak (PPN/PPh)', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],

    ['kode_akun' => '3100', 'nama_akun' => 'Modal & Ekuitas', 'tipe_akun' => 'K', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '3111', 'nama_akun' => 'Modal Disetor', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '3131', 'nama_akun' => 'Laba (Rugi) Tahun Berjalan', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],

    ['kode_akun' => '4100', 'nama_akun' => 'Pendapatan Medis', 'tipe_akun' => 'K', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '4111', 'nama_akun' => 'Pendapatan Rawat Jalan', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '4112', 'nama_akun' => 'Pendapatan Rawat Inap', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    ['kode_akun' => '4121', 'nama_akun' => 'Pendapatan Farmasi / Apotek', 'tipe_akun' => 'D', 'saldo_normal' => 'Kredit', 'status_aktif' => true],
    
    ['kode_akun' => '5100', 'nama_akun' => 'Harga Pokok Penjualan (HPP)', 'tipe_akun' => 'K', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '5111', 'nama_akun' => 'HPP Obat & Farmasi', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '5112', 'nama_akun' => 'HPP Barang Medis Habis Pakai', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],

    ['kode_akun' => '6100', 'nama_akun' => 'Biaya Operasional', 'tipe_akun' => 'K', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '6111', 'nama_akun' => 'Biaya Gaji / Upah Karyawan', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '6112', 'nama_akun' => 'Biaya Jasa Medis Dokter', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
    ['kode_akun' => '6211', 'nama_akun' => 'Biaya Listrik, Air & Telepon', 'tipe_akun' => 'D', 'saldo_normal' => 'Debit', 'status_aktif' => true],
];

foreach ($coas as $coa) {
    Coa::updateOrCreate(
        ['kode_akun' => $coa['kode_akun']],
        [
            'nama_akun' => $coa['nama_akun'],
            'tipe_akun' => $coa['tipe_akun'],
            'saldo_normal' => $coa['saldo_normal'],
            'status_aktif' => $coa['status_aktif'],
        ]
    );
}

echo "COA Template berhasil ditambahkan ke database!\n";
