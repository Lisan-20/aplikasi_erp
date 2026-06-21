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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_rawat_jalan_v
AS
SELECT     dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, 
                      YEAR(dbo.tc_trans_kasir.tgl_jam) AS tahun, dbo.tc_trans_pelayanan.kode_bagian, 9 AS kode_klasifikasi, dbo.tc_trans_kasir.nama_pasien
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_bagian LIKE '01%') OR
                      (dbo.tc_trans_pelayanan.kode_bagian LIKE '02%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_rawat_jalan_v]");
    }
};
