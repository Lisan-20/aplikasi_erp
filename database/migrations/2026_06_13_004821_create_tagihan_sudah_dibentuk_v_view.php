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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_sudah_dibentuk_v
AS
SELECT     TOP (100) PERCENT dbo.tc_tagih.jenis_tagih, SUM(dbo.tc_tagih.jumlah_tagih) AS jumlah_tagih, MONTH(dbo.tc_tagih_det.tgl_kui) AS bln, dbo.tc_tagih.tahun AS thn, 
                      dbo.tc_tagih.status_batal, SUM(dbo.tc_bayar_tagih.diskon) AS diskon, dbo.tc_tagih.id_tertagih, dbo.mt_perusahaan.flag_jpk, dbo.mt_perusahaan.flag_kapitasi, 
                      dbo.tc_tagih.no_invoice_tagih, SUM(dbo.tc_tagih_det.jumlah_tagih) AS jml_tagih
FROM         dbo.tc_tagih_det INNER JOIN
                      dbo.tc_tagih ON dbo.tc_tagih_det.id_tc_tagih = dbo.tc_tagih.id_tc_tagih LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_tagih.id_tertagih = dbo.mt_perusahaan.kode_perusahaan LEFT OUTER JOIN
                      dbo.tc_bayar_tagih ON dbo.tc_tagih.id_tc_tagih = dbo.tc_bayar_tagih.id_tc_tagih
GROUP BY dbo.tc_tagih.jenis_tagih, MONTH(dbo.tc_tagih_det.tgl_kui), dbo.tc_tagih.tahun, dbo.tc_tagih.status_batal, dbo.tc_tagih.id_tertagih, dbo.mt_perusahaan.flag_jpk, 
                      dbo.mt_perusahaan.flag_kapitasi, dbo.tc_tagih.no_invoice_tagih
HAVING      (dbo.tc_tagih.status_batal IS NULL)
ORDER BY MONTH(dbo.tc_tagih_det.tgl_kui)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_sudah_dibentuk_v]");
    }
};
