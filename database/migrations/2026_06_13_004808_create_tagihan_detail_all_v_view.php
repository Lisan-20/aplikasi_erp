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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_detail_all_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, SUM(CASE WHEN tagihan_penunjang_v.bill_rs IS NULL THEN 0 ELSE tagihan_penunjang_v.bill_rs END) AS penunjang, 
                      SUM(CASE WHEN dbo.tagihan_farmasi_v.bill_rs IS NULL THEN 0 ELSE dbo.tagihan_farmasi_v.bill_rs END) AS farmasi, 
                      SUM(CASE WHEN tagihan_tindakan_sum_v.bill_rs IS NULL THEN 0 ELSE tagihan_tindakan_sum_v.bill_rs END) AS tindakan, 
                      SUM(CASE WHEN tagihan_konsul_v.bill_rs IS NULL THEN 0 ELSE tagihan_konsul_v.bill_rs END) AS konsultasi, SUM(CASE WHEN tagihan_adm_v.bill_rs IS NULL 
                      THEN 0 ELSE tagihan_adm_v.bill_rs END) AS administrasi, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.flag_tagih, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.nik, dbo.mt_bagian.nama_bagian, dbo.tc_trans_kasir.nama_pasien
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.tagihan_tindakan_sum_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tagihan_tindakan_sum_v.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.tagihan_adm_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tagihan_adm_v.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.tagihan_farmasi_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tagihan_farmasi_v.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.tagihan_penunjang_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tagihan_penunjang_v.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.tagihan_konsul_v ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tagihan_konsul_v.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.flag_tagih, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.nik, dbo.mt_bagian.nama_bagian, dbo.tc_trans_kasir.nama_pasien
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_detail_all_v]");
    }
};
