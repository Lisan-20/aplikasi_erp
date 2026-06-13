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
        DB::statement("CREATE VIEW dbo.mt_tarif_bedah_v2
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, dbo.mt_master_tarif_detail_bedah.bill_dr2, dbo.mt_master_tarif_detail_bedah.total, 
                      dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_tgl_tarif.kode_tgl_tarif, dbo.mt_tgl_tarif.status, dbo.mt_master_tarif_detail_bedah.kode, dbo.mt_master_tarif.jenis_tindakan, 
                      dbo.mt_master_tarif_detail_bedah.alkes, dbo.mt_master_tarif_detail_bedah.bhp, dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif_detail_bedah.bill_dr3, dbo.mt_master_tarif.paket_mcu, 
                      dbo.mt_master_tarif.flag_reg, dbo.mt_master_tarif_detail_bedah.bill_rs_ass, dbo.mt_master_tarif_detail_bedah.bill_dr1_ass, dbo.mt_master_tarif_detail_bedah.bill_dr2_ass, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr2_inhealth, 
                      dbo.mt_master_tarif_detail_bedah.total_inhealth1, dbo.mt_master_tarif_detail_bedah.total_ass, dbo.mt_master_tarif_detail_bedah.total_bpjs, 
                      CAST('[' + dbo.mt_master_tarif.kode_tindakan + ']' AS varchar) AS kode_tind, dbo.mt_master_tarif_detail_bedah.adm, dbo.mt_master_tarif_detail_bedah.no_urut
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_master_tarif_detail_bedah.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif
WHERE     (dbo.mt_tgl_tarif.status = 1) AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah_v2]");
    }
};
