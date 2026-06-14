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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_obat_expired_v
AS
SELECT     dbo.tc_penerimaan_barang_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tc_penerimaan_barang_detail.tgl_kadaluarsa, 
                      dbo.tc_penerimaan_barang_detail.flag_expired, dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang.no_faktur, dbo.mt_barang.flag_medis, dbo.mt_depo_stok.kode_bagian
FROM         dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan INNER JOIN
                      dbo.mt_barang ON dbo.tc_penerimaan_barang_detail.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.tc_penerimaan_barang_detail.flag_expired IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_obat_expired_v]");
    }
};
