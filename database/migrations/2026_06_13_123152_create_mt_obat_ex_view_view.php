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
        DB::statement("CREATE VIEW dbo.mt_obat_ex_view
AS
SELECT     dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang_detail.tgl_kadaluarsa, dbo.tc_penerimaan_barang_detail.no_faktur, dbo.tc_penerimaan_barang_detail.flag_expired, 
                      dbo.mt_barang.nama_brg, dbo.mt_barang.kode_brg, dbo.tc_penerimaan_barang.kode_penerimaan
FROM         dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan INNER JOIN
                      dbo.mt_barang ON dbo.tc_penerimaan_barang_detail.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_penerimaan_barang_detail.flag_expired IS NULL) AND (dbo.mt_barang.kode_brg LIKE '%E01A0%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_obat_ex_view]");
    }
};
