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
        DB::statement("CREATE OR ALTER VIEW dbo.admin_mt_tarif_bedah_view2
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.referensi, dbo.mt_master_tarif.jenis_tindakan, 
                      dbo.mt_master_tarif.paket_askes, dbo.mt_tarif_bedah_v2.bill_rs, dbo.mt_tarif_bedah_v2.kode_klas, dbo.mt_tarif_bedah_v2.bill_dr1, dbo.mt_tarif_bedah_v2.bill_dr2, dbo.mt_tarif_bedah_v2.total, 
                      dbo.mt_tarif_bedah_v2.kode_tgl_tarif, dbo.mt_tarif_bedah_v2.kode, dbo.mt_tarif_bedah_v2.nama_klas, dbo.mt_tarif_bedah_v2.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_tgl_tarif.tgl_berlaku, dbo.mt_tgl_tarif.status, dbo.mt_master_tarif.kode_tindakan, dbo.mt_tarif_bedah_v2.bill_dr3, dbo.mt_tarif_bedah_v2.bill_rs_ass, dbo.mt_tarif_bedah_v2.bill_dr1_ass, 
                      dbo.mt_tarif_bedah_v2.bill_dr2_ass, dbo.mt_tarif_bedah_v2.bill_rs_bpjs, dbo.mt_tarif_bedah_v2.bill_dr1_bpjs, dbo.mt_tarif_bedah_v2.bill_dr2_bpjs, dbo.mt_tarif_bedah_v2.flag_reg, 
                      dbo.mt_tarif_bedah_v2.bill_rs_inhealth, dbo.mt_tarif_bedah_v2.bill_dr1_inhealth, dbo.mt_tarif_bedah_v2.bill_dr2_inhealth, dbo.mt_tarif_bedah_v2.total_inhealth1
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_tarif_bedah_v2 ON dbo.mt_bagian.kode_bagian = dbo.mt_tarif_bedah_v2.kode_bagian INNER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_tarif_bedah_v2.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif RIGHT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.mt_tarif_bedah_v2.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_mt_tarif_bedah_view2]");
    }
};
