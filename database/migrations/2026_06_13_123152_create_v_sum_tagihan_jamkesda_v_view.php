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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_tagihan_jamkesda_v
AS
SELECT     dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.tgl_jam, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_pasien.no_askes, SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) + SUM(CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) + SUM(CASE WHEN bill_dr2 IS NULL
                       THEN 0 ELSE bill_dr2 END) + SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) AS biaya, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                      dbo.mt_master_pasien.nama_kel_pasien AS nama_karyawan_old, dbo.tc_trans_kasir.no_mr, dbo.mt_pasien_penunjang.nama_pasien AS nama_pasien_penunjang, dbo.tc_trans_kasir.seri_kuitansi,
                       dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_bagian, dbo.mt_master_pasien.wil_krj, dbo.tc_trans_kasir.materai, dbo.tc_trans_kasir.flag_tagih, 
                      dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_registrasi.no_jaminan, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_registrasi.nik, dbo.mt_master_pasien.milik, 
                      dbo.mt_master_pasien.nama_karyawan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.nk_bpjs
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_pasien_penunjang ON dbo.tc_trans_kasir.no_mr = dbo.mt_pasien_penunjang.no_pm LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.mt_karyawan RIGHT OUTER JOIN
                      dbo.tc_registrasi ON dbo.mt_karyawan.kode_dokter = dbo.tc_registrasi.kode_dokter ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
GROUP BY dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.tgl_jam, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_pasien.no_askes, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.mt_master_pasien.nama_kel_pasien, dbo.tc_trans_kasir.no_mr, dbo.mt_pasien_penunjang.nama_pasien, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_bagian, dbo.mt_master_pasien.wil_krj, dbo.tc_trans_kasir.materai, dbo.tc_trans_kasir.flag_tagih, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_registrasi.no_jaminan, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_registrasi.nik, dbo.mt_master_pasien.milik, dbo.mt_master_pasien.nama_karyawan, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.nk_bpjs
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_tagihan_jamkesda_v]");
    }
};
