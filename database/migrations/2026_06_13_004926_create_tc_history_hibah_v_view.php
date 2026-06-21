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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_history_hibah_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.kode_bagian, dbo.tc_kartu_stok.keterangan, 
                      dbo.tc_kartu_stok.pemasukan AS jml_sat_kcl, dbo.tc_kartu_stok.tgl_input, dbo.mt_barang.satuan_kecil, dbo.tc_kartu_stok.petugas, dbo.dd_user.username, dbo.mt_barang.flag_medis
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_barang ON dbo.tc_kartu_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.dd_user ON dbo.tc_kartu_stok.petugas = dbo.dd_user.id_dd_user
WHERE     (dbo.tc_kartu_stok.jenis_transaksi = 13)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_history_hibah_v]");
    }
};
