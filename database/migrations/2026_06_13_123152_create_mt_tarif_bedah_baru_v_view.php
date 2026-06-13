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
        DB::statement("CREATE VIEW dbo.mt_tarif_bedah_baru_v
AS
SELECT     dbo.mt_master_tarif_detail_bedah.kode, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2, dbo.mt_master_tarif_detail_bedah.kode_tgl_tarif, dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif_detail_bedah.total, 
                      dbo.mt_master_tarif_detail_bedah.obat, dbo.mt_master_tarif_detail_bedah.alkes, dbo.mt_master_tarif_detail_bedah.alat_rs, dbo.mt_master_tarif_detail_bedah.adm, 
                      dbo.mt_master_tarif_detail_bedah.bhp, dbo.mt_master_tarif_detail_bedah.keterangan, dbo.mt_master_tarif_detail_bedah.pendapatan_rs, dbo.mt_master_tarif_detail_bedah.bill_dr3, 
                      dbo.mt_master_tarif_detail_bedah.kamar_tindakan, dbo.mt_master_tarif_detail_bedah.paramedis, dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.no_urut, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.mt_master_tarif_detail_bedah.total_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_nayaka, dbo.mt_master_tarif_detail_bedah.bill_dr1_nayaka, dbo.mt_master_tarif_detail_bedah.bill_dr2_nayaka, 
                      dbo.mt_master_tarif_detail_bedah.total_nayaka, dbo.mt_master_tarif_detail_bedah.bill_rs_hardlent, dbo.mt_master_tarif_detail_bedah.bill_dr1_hardlent, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2_hardlent, dbo.mt_master_tarif_detail_bedah.total_hardlent, dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr2_inhealth, dbo.mt_master_tarif_detail_bedah.total_inhealth1, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_cahaya, dbo.mt_master_tarif_detail_bedah.bill_dr1_cahaya, dbo.mt_master_tarif_detail_bedah.bill_dr2_cahaya, 
                      dbo.mt_master_tarif_detail_bedah.total_cahaya, dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, 
                      dbo.mt_master_tarif.jenis_tindakan
FROM         dbo.mt_master_tarif_detail_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4 = dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah_baru_v]");
    }
};
