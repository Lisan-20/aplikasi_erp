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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_nk_tagihan_pt
AS
SELECT     dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.mt_bagian.nama_bagian, SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) + SUM(CASE WHEN bill_dr1 IS NULL 
                      THEN 0 ELSE bill_dr1 END) + SUM(CASE WHEN bill_dr2 IS NULL THEN 0 ELSE bill_dr2 END) + SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) 
                      AS biaya, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_tagih_det.nama_pasien, dbo.tc_trans_kasir.materai
FROM         dbo.tc_tagih_det INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_tagih_det.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_tagih ON dbo.tc_tagih_det.id_tc_tagih = dbo.tc_tagih.id_tc_tagih INNER JOIN
                      dbo.tc_trans_kasir INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_kasir.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian ON dbo.tc_tagih.id_tc_tagih = dbo.tc_trans_kasir.kd_inv_persh_tx AND 
                      dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.mt_perusahaan.flag = 0 OR
                      dbo.mt_perusahaan.flag IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND 
                      (NOT (dbo.tc_trans_kasir.kd_inv_persh_tx IS NULL))
GROUP BY dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.mt_bagian.nama_bagian, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_tagih_det.nama_pasien, dbo.tc_trans_kasir.materai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_nk_tagihan_pt]");
    }
};
