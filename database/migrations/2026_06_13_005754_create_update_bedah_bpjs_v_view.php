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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bedah_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.bpjs_bedah_new.nama_tindakan, dbo.bpjs_bedah_new.bill_dr, dbo.bpjs_bedah_new.bill_rs, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.bpjs_bedah_new.no_urut, dbo.mt_master_tarif_detail_bedah.kode_klas, 
                      dbo.bpjs_bedah_new.total, dbo.mt_master_tarif_detail_bedah.total_bpjs
FROM         dbo.bpjs_bedah_new INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.bpjs_bedah_new.referensi = dbo.mt_master_tarif_detail_bedah.referensi AND 
                      dbo.bpjs_bedah_new.no_urut = dbo.mt_master_tarif_detail_bedah.no_urut
WHERE     (dbo.mt_master_tarif_detail_bedah.kode_klas IN (5, 6, 7)) AND (dbo.mt_master_tarif_detail_bedah.kode_tarif NOT IN (309040305, 309040206, 309040101, 309080201))
ORDER BY dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif_detail_bedah.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bedah_bpjs_v]");
    }
};
