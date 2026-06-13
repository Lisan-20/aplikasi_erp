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
        DB::statement("CREATE OR ALTER VIEW dbo.update_showa_v
AS
SELECT     TOP (100) PERCENT dbo.v_sum_nk_tagihan_perusahaan.nk_perusahaan, dbo.v_sum_nk_tagihan_perusahaan.kode_perusahaan, 
                      dbo.v_sum_nk_tagihan_perusahaan.nama_perusahaan, dbo.v_sum_nk_tagihan_perusahaan.no_registrasi, 
                      dbo.v_sum_nk_tagihan_perusahaan.tgl_jam, dbo.v_sum_nk_tagihan_perusahaan.nama_pasien, dbo.v_sum_nk_tagihan_perusahaan.nama_bagian, 
                      dbo.v_sum_nk_tagihan_perusahaan.no_askes, dbo.v_sum_nk_tagihan_perusahaan.biaya, dbo.v_sum_nk_tagihan_perusahaan.kode_tc_trans_kasir, 
                      dbo.v_sum_nk_tagihan_perusahaan.nama_karyawan_old, dbo.v_sum_nk_tagihan_perusahaan.no_mr, 
                      dbo.v_sum_nk_tagihan_perusahaan.nama_pasien_penunjang, dbo.v_sum_nk_tagihan_perusahaan.seri_kuitansi, 
                      dbo.v_sum_nk_tagihan_perusahaan.no_kuitansi, dbo.v_sum_nk_tagihan_perusahaan.kode_bagian, dbo.v_sum_nk_tagihan_perusahaan.wil_krj, 
                      dbo.v_sum_nk_tagihan_perusahaan.materai, dbo.v_sum_nk_tagihan_perusahaan.flag_tagih, dbo.v_sum_nk_tagihan_perusahaan.nama_dokter, 
                      dbo.v_sum_nk_tagihan_perusahaan.no_jaminan, dbo.v_sum_nk_tagihan_perusahaan.kd_inv_persh_tx, dbo.v_sum_nk_tagihan_perusahaan.nik, 
                      dbo.v_sum_nk_tagihan_perusahaan.milik, dbo.v_sum_nk_tagihan_perusahaan.nama_karyawan, dbo.tc_trans_kasir.nk_perusahaan AS nk_showa, 
                      dbo.tc_diskon_showa.billing, dbo.tc_diskon_showa.diskon, dbo.tc_diskon_showa.billing - dbo.tc_diskon_showa.diskon AS tot_nk
FROM         dbo.v_sum_nk_tagihan_perusahaan INNER JOIN
                      dbo.tc_diskon_showa ON dbo.v_sum_nk_tagihan_perusahaan.no_registrasi = dbo.tc_diskon_showa.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_diskon_showa.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND 
                      dbo.v_sum_nk_tagihan_perusahaan.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.v_sum_nk_tagihan_perusahaan.flag_tagih = 1) AND (dbo.v_sum_nk_tagihan_perusahaan.kode_perusahaan = 171) AND 
                      (dbo.v_sum_nk_tagihan_perusahaan.tgl_jam BETWEEN '2-1-2015 00:00:00' AND '2-15-2015 23:59:59') AND 
                      (dbo.v_sum_nk_tagihan_perusahaan.seri_kuitansi IN ('NK', 'AJ')) AND (dbo.v_sum_nk_tagihan_perusahaan.kd_inv_persh_tx IS NULL OR
                      dbo.v_sum_nk_tagihan_perusahaan.kd_inv_persh_tx = 0)
ORDER BY dbo.v_sum_nk_tagihan_perusahaan.tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_showa_v]");
    }
};
