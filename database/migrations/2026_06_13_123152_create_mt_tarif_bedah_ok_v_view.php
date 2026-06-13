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
        DB::statement("CREATE VIEW dbo.mt_tarif_bedah_ok_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.ket, SUM(dbo.mt_master_tarif_detail_bedah.bill_rs) AS bill_rs, 
                      SUM(dbo.mt_master_tarif_detail_bedah.bill_dr1) AS bill_dr1, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr2) AS bill_dr2, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr3) AS bill_dr3, 
                      SUM(dbo.mt_master_tarif_detail_bedah.total) AS total, 
                      SUM(dbo.mt_master_tarif_detail_bedah.bill_rs + dbo.mt_master_tarif_detail_bedah.bill_dr1 + dbo.mt_master_tarif_detail_bedah.bill_dr2 + dbo.mt_master_tarif_detail_bedah.bill_dr3) AS tot, 
                      dbo.mt_master_tarif_detail_bedah.kamar_tindakan, dbo.mt_master_tarif_detail_bedah.keterangan, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.tarif_bedah_level3_v.nama_tarif AS bagian, 
                      dbo.tarif_bedah_level4_v.nama_tarif AS jenis_operasi, dbo.mt_master_tarif.nama_tarif AS nama_operasi, dbo.mt_klas.nama_klas, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.mt_master_tarif_detail_bedah.total_bpjs, dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.no_urut, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, dbo.mt_master_tarif_detail_bedah.total_inhealth1, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_ass, dbo.mt_master_tarif_detail_bedah.bill_rs_ass, dbo.mt_master_tarif_detail_bedah.total_ass, dbo.mt_master_tarif_detail_bedah.bill_dr2_ass
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.tarif_bedah_level5_v ON dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.tarif_bedah_level5_v.kode_tarif INNER JOIN
                      dbo.tarif_bedah_level4_v ON dbo.tarif_bedah_level5_v.referensi = dbo.tarif_bedah_level4_v.kode_tarif INNER JOIN
                      dbo.tarif_bedah_level3_v ON dbo.tarif_bedah_level4_v.referensi = dbo.tarif_bedah_level3_v.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian = 030901)
GROUP BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.ket, 
                      dbo.mt_master_tarif_detail_bedah.kamar_tindakan, dbo.mt_master_tarif_detail_bedah.keterangan, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.tarif_bedah_level4_v.nama_tarif, dbo.tarif_bedah_level3_v.nama_tarif, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.total_bpjs, dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.no_urut, dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, dbo.mt_master_tarif_detail_bedah.total_inhealth1, dbo.mt_master_tarif_detail_bedah.bill_dr1_ass, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_ass, dbo.mt_master_tarif_detail_bedah.total_ass, dbo.mt_master_tarif_detail_bedah.bill_dr2_ass
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah_ok_v]");
    }
};
