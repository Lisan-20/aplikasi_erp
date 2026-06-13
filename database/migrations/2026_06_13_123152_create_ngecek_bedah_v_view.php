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
        DB::statement("CREATE VIEW dbo.ngecek_bedah_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, dbo.mt_klas.nama_klas, mt_master_tarif_1.nama_tarif AS Expr1, dbo.mt_master_tarif.kode_tarif, 
                      dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, 
                      dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.total_bpjs, dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.no_urut
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ngecek_bedah_v]");
    }
};
