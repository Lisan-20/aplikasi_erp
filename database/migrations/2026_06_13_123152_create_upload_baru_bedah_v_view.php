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
        DB::statement("CREATE VIEW dbo.upload_baru_bedah_v
AS
SELECT     TOP (100) PERCENT dbo.bedah_upload_v.kode_tarif, dbo.bedah_upload_v.nama_tarif, dbo.bedah_upload_v.referensi, cek_bedah_baru_bgd_1.kode, cek_bedah_baru_bgd_1.kode_klas, 
                      cek_bedah_baru_bgd_1.bill_rs, cek_bedah_baru_bgd_1.bill_dr1, cek_bedah_baru_bgd_1.bill_dr2, cek_bedah_baru_bgd_1.kode_tgl_tarif, cek_bedah_baru_bgd_1.kode_tarif AS Expr1, 
                      cek_bedah_baru_bgd_1.total, cek_bedah_baru_bgd_1.obat, cek_bedah_baru_bgd_1.alkes, cek_bedah_baru_bgd_1.alat_rs, cek_bedah_baru_bgd_1.adm, cek_bedah_baru_bgd_1.bhp, 
                      cek_bedah_baru_bgd_1.keterangan, cek_bedah_baru_bgd_1.pendapatan_rs, cek_bedah_baru_bgd_1.bill_dr3, cek_bedah_baru_bgd_1.kamar_tindakan, cek_bedah_baru_bgd_1.paramedis, 
                      cek_bedah_baru_bgd_1.detail, cek_bedah_baru_bgd_1.no_urut, cek_bedah_baru_bgd_1.bill_dr1_bpjs, cek_bedah_baru_bgd_1.bill_rs_bpjs, cek_bedah_baru_bgd_1.bill_dr2_bpjs, 
                      cek_bedah_baru_bgd_1.total_bpjs, cek_bedah_baru_bgd_1.bill_rs_nayaka, cek_bedah_baru_bgd_1.bill_dr1_nayaka, cek_bedah_baru_bgd_1.bill_dr2_nayaka, 
                      cek_bedah_baru_bgd_1.total_nayaka, cek_bedah_baru_bgd_1.bill_rs_hardlent, cek_bedah_baru_bgd_1.bill_dr1_hardlent, cek_bedah_baru_bgd_1.bill_dr2_hardlent, 
                      cek_bedah_baru_bgd_1.total_hardlent, cek_bedah_baru_bgd_1.bill_rs_inhealth, cek_bedah_baru_bgd_1.bill_dr1_inhealth, cek_bedah_baru_bgd_1.bill_dr2_inhealth, 
                      cek_bedah_baru_bgd_1.total_inhealth1, cek_bedah_baru_bgd_1.bill_rs_cahaya, cek_bedah_baru_bgd_1.bill_dr1_cahaya, cek_bedah_baru_bgd_1.bill_dr2_cahaya, 
                      cek_bedah_baru_bgd_1.total_cahaya, cek_bedah_baru_bgd_1.kode_tarif_lev4, cek_bedah_baru_bgd_1.bill_rs_kapitasi, cek_bedah_baru_bgd_1.bill_dr1_kapitasi, 
                      cek_bedah_baru_bgd_1.bill_dr2_kapitasi, cek_bedah_baru_bgd_1.total_kapitasi
FROM         dbo.bedah_upload_v INNER JOIN
                      dbo.cek_bedah_baru_bgd AS cek_bedah_baru_bgd_1 ON dbo.bedah_upload_v.referensi = cek_bedah_baru_bgd_1.kode_tarif_lev4 LEFT OUTER JOIN
                      dbo.cek_bedah_baru_bgd ON dbo.bedah_upload_v.kode_tarif = dbo.cek_bedah_baru_bgd.kode_tarif
WHERE     (dbo.cek_bedah_baru_bgd.kode_tarif IS NULL)
ORDER BY dbo.bedah_upload_v.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upload_baru_bedah_v]");
    }
};
