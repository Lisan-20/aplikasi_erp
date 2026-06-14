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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_blm_dibayar_v
AS
SELECT     TOP (100) PERCENT dbo.mt_perusahaan.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, SUM(dbo.tc_tagih.jumlah_tagih) AS jumlah_tagihan, 
                      dbo.tc_tagih.status_batal
FROM         dbo.tc_tagih INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_tagih.id_tertagih = dbo.mt_perusahaan.kode_perusahaan LEFT OUTER JOIN
                      dbo.tc_bayar_tagih ON dbo.tc_tagih.id_tc_tagih = dbo.tc_bayar_tagih.id_tc_tagih
GROUP BY dbo.mt_perusahaan.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, YEAR(dbo.tc_tagih.tgl_tagih), YEAR(dbo.tc_bayar_tagih.tgl_bayar), 
                      dbo.tc_bayar_tagih.id_tc_tagih, dbo.tc_tagih.status_batal
HAVING      (YEAR(dbo.tc_tagih.tgl_tagih) = 2013) AND (dbo.tc_bayar_tagih.id_tc_tagih IS NULL) AND (dbo.tc_tagih.status_batal IS NULL)
ORDER BY dbo.mt_perusahaan.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_blm_dibayar_v]");
    }
};
