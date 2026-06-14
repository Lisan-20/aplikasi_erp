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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_nk_tagihan_cahaya
AS
SELECT     dbo.v_sum_nk_tagihan_asuransi.nk_perusahaan, dbo.v_sum_nk_tagihan_asuransi.kode_perusahaan, dbo.v_sum_nk_tagihan_asuransi.nama_perusahaan, 
                      dbo.v_sum_nk_tagihan_asuransi.no_registrasi, dbo.v_sum_nk_tagihan_asuransi.tgl_jam, dbo.v_sum_nk_tagihan_asuransi.nama_bagian, 
                      dbo.v_sum_nk_tagihan_asuransi.kode_tc_trans_kasir, dbo.v_sum_nk_tagihan_asuransi.seri_kuitansi, dbo.v_sum_nk_tagihan_asuransi.no_kuitansi, 
                      dbo.v_sum_nk_tagihan_asuransi.kode_bagian, dbo.v_sum_nk_tagihan_asuransi.kd_inv_umum_tx, dbo.v_sum_nk_tagihan_asuransi.kd_inv_askes, 
                      dbo.v_sum_nk_tagihan_asuransi.kd_inv_persh_tx, dbo.v_sum_nk_tagihan_asuransi.kd_inv_kary_tx, dbo.v_sum_nk_tagihan_asuransi.Expr1, 
                      dbo.v_sum_nk_tagihan_asuransi.no_mr, dbo.v_sum_nk_tagihan_asuransi.materai, dbo.v_sum_nk_tagihan_asuransi.flag_tagih, dbo.v_sum_nk_tagihan_asuransi.nik,
                       dbo.v_sum_nk_tagihan_asuransi.nama_dokter, dbo.v_sum_nk_tagihan_asuransi.nama_karyawan, dbo.v_sum_nk_tagihan_asuransi.no_jaminan, 
                      dbo.v_sum_nk_tagihan_asuransi.tgl_jam_masuk, dbo.v_sum_nk_tagihan_asuransi.tgl_jam_keluar, dbo.v_sum_nk_tagihan_asuransi.nama_pasien, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir AS kasir_obat, 
                      CASE WHEN dbo.tc_trans_kasir.nk_perusahaan = 0 THEN dbo.tc_trans_kasir.nk ELSE dbo.tc_trans_kasir.nk_perusahaan END AS billing_obat, 
                      dbo.tc_trans_kasir.kode_ri
FROM         dbo.v_sum_nk_tagihan_asuransi LEFT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.v_sum_nk_tagihan_asuransi.no_registrasi = dbo.tc_trans_kasir.no_reg_resep AND 
                      dbo.v_sum_nk_tagihan_asuransi.no_mr = dbo.tc_trans_kasir.no_mr
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.v_sum_nk_tagihan_asuransi.kode_perusahaan = 296)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_nk_tagihan_cahaya]");
    }
};
