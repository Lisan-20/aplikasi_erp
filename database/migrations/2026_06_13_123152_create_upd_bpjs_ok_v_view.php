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
        DB::statement("CREATE VIEW dbo.upd_bpjs_ok_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.upd_bpjs_ok4.operasi AS nama, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_tindakan, 
                      dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif_detail_bedah.detail, 
                      dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif.referensi, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.upd_bpjs_ok4.klas3, 
                      dbo.upd_bpjs_ok4.tarif
FROM         dbo.upd_bpjs_ok4 INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.upd_bpjs_ok4.tarif = dbo.mt_master_tarif_detail_bedah.detail INNER JOIN
                      dbo.mt_master_tarif ON dbo.upd_bpjs_ok4.operasi = dbo.mt_master_tarif.nama_tarif AND 
                      dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif_detail_bedah.kode_klas = 7) AND (dbo.mt_master_tarif_detail_bedah.detail = 'ASISTEN')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bpjs_ok_v]");
    }
};
