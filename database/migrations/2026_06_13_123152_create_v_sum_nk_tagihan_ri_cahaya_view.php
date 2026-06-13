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
        DB::statement("CREATE VIEW dbo.v_sum_nk_tagihan_ri_cahaya
AS
SELECT     TOP (100) PERCENT dbo.v_sum_nk_tagihan_perusahaan.nk_perusahaan, dbo.v_sum_nk_tagihan_perusahaan.kode_perusahaan, 
                      dbo.v_sum_nk_tagihan_perusahaan.nama_perusahaan, dbo.v_sum_nk_tagihan_perusahaan.no_registrasi, dbo.v_sum_nk_tagihan_perusahaan.tgl_jam, 
                      dbo.v_sum_nk_tagihan_perusahaan.nama_pasien, dbo.v_sum_nk_tagihan_perusahaan.nama_bagian, dbo.v_sum_nk_tagihan_perusahaan.no_askes, 
                      dbo.v_sum_nk_tagihan_perusahaan.biaya, dbo.v_sum_nk_tagihan_perusahaan.kode_tc_trans_kasir, dbo.v_sum_nk_tagihan_perusahaan.nama_karyawan_old, 
                      dbo.v_sum_nk_tagihan_perusahaan.no_mr, dbo.v_sum_nk_tagihan_perusahaan.nama_pasien_penunjang, dbo.v_sum_nk_tagihan_perusahaan.seri_kuitansi, 
                      dbo.v_sum_nk_tagihan_perusahaan.no_kuitansi, dbo.v_sum_nk_tagihan_perusahaan.kode_bagian, dbo.v_sum_nk_tagihan_perusahaan.wil_krj, 
                      dbo.v_sum_nk_tagihan_perusahaan.materai, dbo.v_sum_nk_tagihan_perusahaan.flag_tagih, dbo.v_sum_nk_tagihan_perusahaan.nama_dokter, 
                      dbo.v_sum_nk_tagihan_perusahaan.no_jaminan, dbo.v_sum_nk_tagihan_perusahaan.kd_inv_persh_tx, dbo.v_sum_nk_tagihan_perusahaan.nik, 
                      dbo.v_sum_nk_tagihan_perusahaan.milik, dbo.v_sum_nk_tagihan_perusahaan.nama_karyawan, dbo.v_sum_nk_tagihan_perusahaan.kode_kelompok, 
                      dbo.tc_trans_kasir.nk_perusahaan AS billing_obat, dbo.tc_trans_kasir.no_reg_resep, dbo.tc_trans_kasir.kode_tc_trans_kasir AS kode_tc_trans_kasir_obat
FROM         dbo.v_sum_nk_tagihan_perusahaan LEFT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.v_sum_nk_tagihan_perusahaan.no_registrasi = dbo.tc_trans_kasir.no_reg_resep
WHERE     (dbo.v_sum_nk_tagihan_perusahaan.flag_tagih = 1) AND (dbo.v_sum_nk_tagihan_perusahaan.kode_perusahaan = 296) AND 
                      (dbo.v_sum_nk_tagihan_perusahaan.kd_inv_persh_tx IS NULL OR
                      dbo.v_sum_nk_tagihan_perusahaan.kd_inv_persh_tx = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL)
ORDER BY dbo.v_sum_nk_tagihan_perusahaan.tgl_jam, dbo.v_sum_nk_tagihan_perusahaan.nama_pasien, dbo.v_sum_nk_tagihan_perusahaan.nama_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_nk_tagihan_ri_cahaya]");
    }
};
