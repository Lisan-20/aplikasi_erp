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
        DB::statement("CREATE OR ALTER VIEW dbo.v_trans_farmasi_rj_pt
AS
SELECT     dbo.v_trans_far_pt_RJ_v.kode_trans_pelayanan, dbo.v_trans_far_pt_RJ_v.kode_tc_trans_kasir, dbo.v_trans_far_pt_RJ_v.no_kunjungan, 
                      dbo.v_trans_far_pt_RJ_v.no_registrasi, dbo.v_trans_far_pt_RJ_v.no_mr, dbo.v_trans_far_pt_RJ_v.nama_pasien_layan, dbo.v_trans_far_pt_RJ_v.kode_kelompok, 
                      dbo.v_trans_far_pt_RJ_v.kode_perusahaan, dbo.v_trans_far_pt_RJ_v.jenis_tindakan, dbo.v_trans_far_pt_RJ_v.nama_tindakan, dbo.v_trans_far_pt_RJ_v.bill_rs, 
                      dbo.v_trans_far_pt_RJ_v.bill_rs_jatah, dbo.v_trans_far_pt_RJ_v.lain_lain, dbo.v_trans_far_pt_RJ_v.kode_dokter1, dbo.v_trans_far_pt_RJ_v.jumlah, 
                      dbo.v_trans_far_pt_RJ_v.kode_barang, dbo.v_trans_far_pt_RJ_v.kd_tr_resep, dbo.v_trans_far_pt_RJ_v.kode_trans_far, dbo.v_trans_far_pt_RJ_v.kode_tarif, 
                      dbo.v_trans_far_pt_RJ_v.kode_bagian, dbo.v_trans_far_pt_RJ_v.kode_bagian_asal, dbo.v_trans_far_pt_RJ_v.kode_klas, dbo.v_trans_far_pt_RJ_v.kode_profit, 
                      dbo.v_trans_far_pt_RJ_v.status_selesai, dbo.v_trans_far_pt_RJ_v.status_kredit, dbo.v_trans_far_pt_RJ_v.tgl_ver, dbo.v_trans_far_pt_RJ_v.tgl_jam, 
                      dbo.v_trans_far_pt_RJ_v.flag_jurnal, dbo.v_trans_far_pt_RJ_v.no_kuitansi, dbo.v_trans_far_pt_RJ_v.seri_kuitansi, dbo.v_trans_far_pt_RJ_v.flag, 
                      CASE WHEN v_trans_far_pt_RJ_retur.bill_rs IS NULL THEN 0 ELSE v_trans_far_pt_RJ_retur.bill_rs END AS bill_rs_ret, 
                      CASE WHEN v_trans_far_pt_RJ_retur.bill_rs_jatah IS NULL THEN 0 ELSE v_trans_far_pt_RJ_retur.bill_rs_jatah END AS bill_rs_jatah_ret, 
                      CASE WHEN v_trans_far_pt_RJ_retur.jumlah IS NULL THEN 0 ELSE v_trans_far_pt_RJ_retur.jumlah END AS jumlah_ret, 
                      CASE WHEN v_trans_far_pt_RJ_retur.lain_lain IS NULL THEN 0 ELSE v_trans_far_pt_RJ_retur.lain_lain END AS lain_lain_ret
FROM         dbo.v_trans_far_pt_RJ_v LEFT OUTER JOIN
                      dbo.v_trans_far_pt_RJ_retur ON dbo.v_trans_far_pt_RJ_v.kd_tr_resep = dbo.v_trans_far_pt_RJ_retur.kd_tr_resep AND 
                      dbo.v_trans_far_pt_RJ_v.kode_tc_trans_kasir = dbo.v_trans_far_pt_RJ_retur.kode_tc_trans_kasir AND 
                      dbo.v_trans_far_pt_RJ_v.no_registrasi = dbo.v_trans_far_pt_RJ_retur.no_registrasi AND 
                      dbo.v_trans_far_pt_RJ_v.kode_barang = dbo.v_trans_far_pt_RJ_retur.kode_barang AND 
                      dbo.v_trans_far_pt_RJ_v.kode_trans_far = dbo.v_trans_far_pt_RJ_retur.kode_trans_far
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_trans_farmasi_rj_pt]");
    }
};
