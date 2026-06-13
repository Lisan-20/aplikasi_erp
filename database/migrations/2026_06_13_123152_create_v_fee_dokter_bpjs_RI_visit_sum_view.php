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
        DB::statement("CREATE VIEW dbo.v_fee_dokter_bpjs_RI_visit_sum
AS
SELECT     dbo.v_fee_dokter_bpjs_RI_visit.seri_kuitansi, dbo.v_fee_dokter_bpjs_RI_visit.no_kuitansi, dbo.v_fee_dokter_bpjs_RI_visit.kode_tc_trans_kasir, 
                      dbo.v_fee_dokter_bpjs_RI_visit.no_registrasi, dbo.tc_trans_jkn.plafon, dbo.tc_trans_jkn.kode_plafon, dbo.tc_trans_jkn.persen_bpjs, 
                      dbo.tc_trans_jkn.id_jenis_layanan, dbo.mt_plafon_bpjs_detail.persen_dr, dbo.v_fee_dokter_bpjs_RI_visit.no_mr, dbo.v_fee_dokter_bpjs_RI_visit.tgl_jam, 
                      COUNT(dbo.v_fee_dokter_bpjs_RI_visit.no_registrasi) AS jumlah_tindakan, dbo.tc_trans_jkn.nama_pasien_layan AS nama_pasien
FROM         dbo.v_fee_dokter_bpjs_RI_visit INNER JOIN
                      dbo.tc_trans_jkn ON dbo.v_fee_dokter_bpjs_RI_visit.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir AND 
                      dbo.v_fee_dokter_bpjs_RI_visit.no_registrasi = dbo.tc_trans_jkn.no_registrasi INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.tc_trans_jkn.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon AND 
                      dbo.tc_trans_jkn.id_jenis_layanan = dbo.mt_plafon_bpjs_detail.id_jenis_layanan
GROUP BY dbo.v_fee_dokter_bpjs_RI_visit.seri_kuitansi, dbo.v_fee_dokter_bpjs_RI_visit.no_kuitansi, dbo.v_fee_dokter_bpjs_RI_visit.kode_tc_trans_kasir, 
                      dbo.v_fee_dokter_bpjs_RI_visit.no_registrasi, dbo.tc_trans_jkn.plafon, dbo.tc_trans_jkn.kode_plafon, dbo.tc_trans_jkn.persen_bpjs, 
                      dbo.tc_trans_jkn.id_jenis_layanan, dbo.mt_plafon_bpjs_detail.persen_dr, dbo.v_fee_dokter_bpjs_RI_visit.no_mr, dbo.v_fee_dokter_bpjs_RI_visit.tgl_jam, 
                      dbo.tc_trans_jkn.nama_pasien_layan
HAVING      (dbo.tc_trans_jkn.id_jenis_layanan = 6)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_RI_visit_sum]");
    }
};
