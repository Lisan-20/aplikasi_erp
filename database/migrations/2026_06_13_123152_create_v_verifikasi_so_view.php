<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW dbo.v_verifikasi_so
AS
SELECT     dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.pengeluaran, dbo.tc_kartu_stok.pemasukan, YEAR(dbo.tc_kartu_stok.tgl_input) AS Expr1, dbo.tc_kartu_stok.tgl_ver, 
                      dbo.tc_kartu_stok.status_ver, dbo.tc_kartu_stok.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_kartu_stok.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_kartu_stok.id_kartu, 
                      dbo.tc_kartu_stok.tgl_input, dbo.mt_barang.satuan_kecil, dbo.mt_rekap_stok.harga_beli, dbo.tc_kartu_stok.no_induk, dbo.tc_kartu_stok.stok_awal, dbo.tc_kartu_stok.stok_akhir
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_barang.kode_brg = dbo.tc_kartu_stok.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kartu_stok.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_rekap_stok.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_kartu_stok.jenis_transaksi = 9) AND (YEAR(dbo.tc_kartu_stok.tgl_input) >= 2024) AND (dbo.tc_kartu_stok.stok_akhir <> dbo.tc_kartu_stok.stok_awal)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_verifikasi_so]");
    }
};
