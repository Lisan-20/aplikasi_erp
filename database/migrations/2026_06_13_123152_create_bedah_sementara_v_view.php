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
        DB::statement("CREATE VIEW dbo.bedah_sementara_v
AS
SELECT     dbo.bedah_upload_v.kode_tarif, dbo.bedah_upload_v.referensi, dbo.bedah_upload_v.nama_tarif, bedah_terbaru_1.kode_klas, bedah_terbaru_1.bill_rs, bedah_terbaru_1.bill_dr1, 
                      bedah_terbaru_1.bill_dr2, bedah_terbaru_1.total, bedah_terbaru_1.obat, bedah_terbaru_1.alkes, bedah_terbaru_1.alat_rs, bedah_terbaru_1.adm, bedah_terbaru_1.bhp, bedah_terbaru_1.keterangan,
                       bedah_terbaru_1.pendapatan_rs, bedah_terbaru_1.bill_dr3, bedah_terbaru_1.kamar_tindakan, bedah_terbaru_1.paramedis, bedah_terbaru_1.detail, bedah_terbaru_1.no_urut, 
                      bedah_terbaru_1.bill_dr1_bpjs, bedah_terbaru_1.bill_dr2_bpjs, bedah_terbaru_1.bill_rs_bpjs, bedah_terbaru_1.total_bpjs, bedah_terbaru_1.bill_rs_nayaka, bedah_terbaru_1.bill_dr1_nayaka, 
                      bedah_terbaru_1.bill_dr2_nayaka, bedah_terbaru_1.total_nayaka, bedah_terbaru_1.bill_rs_hardlent, bedah_terbaru_1.bill_dr1_hardlent, bedah_terbaru_1.bill_dr2_hardlent, 
                      bedah_terbaru_1.total_hardlent, bedah_terbaru_1.bill_rs_inhealth, bedah_terbaru_1.bill_dr1_inhealth, bedah_terbaru_1.bill_dr2_inhealth, bedah_terbaru_1.total_inhealth1, 
                      bedah_terbaru_1.bill_rs_cahaya, bedah_terbaru_1.bill_dr1_cahaya, bedah_terbaru_1.bill_dr2_cahaya, bedah_terbaru_1.total_cahaya, bedah_terbaru_1.kode_tarif_lev4, 
                      bedah_terbaru_1.bill_rs_kapitasi, bedah_terbaru_1.bill_dr1_kapitasi, bedah_terbaru_1.bill_dr2_kapitasi, bedah_terbaru_1.total_kapitasi, bedah_terbaru_1.kode_tgl_tarif
FROM         dbo.bedah_terbaru AS bedah_terbaru_1 RIGHT OUTER JOIN
                      dbo.bedah_upload_v ON bedah_terbaru_1.kode_tarif_lev4 = dbo.bedah_upload_v.referensi LEFT OUTER JOIN
                      dbo.bedah_terbaru ON dbo.bedah_upload_v.kode_tarif = dbo.bedah_terbaru.kode_tarif
GROUP BY dbo.bedah_upload_v.kode_tarif, dbo.bedah_upload_v.referensi, dbo.bedah_upload_v.nama_tarif, bedah_terbaru_1.kode_klas, bedah_terbaru_1.bill_rs, bedah_terbaru_1.bill_dr1, 
                      bedah_terbaru_1.bill_dr2, bedah_terbaru_1.total, bedah_terbaru_1.obat, bedah_terbaru_1.alkes, bedah_terbaru_1.alat_rs, bedah_terbaru_1.adm, bedah_terbaru_1.bhp, bedah_terbaru_1.keterangan,
                       bedah_terbaru_1.pendapatan_rs, bedah_terbaru_1.bill_dr3, bedah_terbaru_1.kamar_tindakan, bedah_terbaru_1.paramedis, bedah_terbaru_1.detail, bedah_terbaru_1.no_urut, 
                      bedah_terbaru_1.bill_dr1_bpjs, bedah_terbaru_1.bill_dr2_bpjs, bedah_terbaru_1.bill_rs_bpjs, bedah_terbaru_1.total_bpjs, bedah_terbaru_1.bill_rs_nayaka, bedah_terbaru_1.bill_dr1_nayaka, 
                      bedah_terbaru_1.bill_dr2_nayaka, bedah_terbaru_1.total_nayaka, bedah_terbaru_1.bill_rs_hardlent, bedah_terbaru_1.bill_dr1_hardlent, bedah_terbaru_1.bill_dr2_hardlent, 
                      bedah_terbaru_1.total_hardlent, bedah_terbaru_1.bill_rs_inhealth, bedah_terbaru_1.bill_dr1_inhealth, bedah_terbaru_1.bill_dr2_inhealth, bedah_terbaru_1.total_inhealth1, 
                      bedah_terbaru_1.bill_rs_cahaya, bedah_terbaru_1.bill_dr1_cahaya, bedah_terbaru_1.bill_dr2_cahaya, bedah_terbaru_1.total_cahaya, bedah_terbaru_1.kode_tarif_lev4, 
                      bedah_terbaru_1.bill_rs_kapitasi, bedah_terbaru_1.bill_dr1_kapitasi, bedah_terbaru_1.bill_dr2_kapitasi, bedah_terbaru_1.total_kapitasi, bedah_terbaru_1.kode_tgl_tarif
HAVING      (dbo.bedah_upload_v.referensi <> 309040100)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bedah_sementara_v]");
    }
};
