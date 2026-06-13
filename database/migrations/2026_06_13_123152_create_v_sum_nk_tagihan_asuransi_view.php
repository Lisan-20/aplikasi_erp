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
        DB::statement("CREATE VIEW dbo.v_sum_nk_tagihan_asuransi
AS
SELECT DISTINCT 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_perusahaan, dbo.mt_perusahaan_tagih_v.nama_perusahaan, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_registrasi.kode_bagian_keluar AS kode_bagian, 
                      dbo.tc_trans_kasir.kd_inv_umum_tx, dbo.tc_trans_kasir.kd_inv_askes, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.kd_inv_kary_tx, dbo.tc_trans_kasir.kode_bagian AS Expr1, 
                      dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.materai, dbo.tc_trans_kasir.flag_tagih, dbo.mt_master_pasien.nik, dbo.mt_karyawan.nama_pegawai AS nama_dokter, 
                      dbo.mt_master_pasien.nama_karyawan, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_trans_kasir.nama_pasien, 
                      dbo.tc_trans_kasir.kode_ri, dbo.tc_registrasi.kode_kelompok
FROM         dbo.mt_pasien_penunjang RIGHT OUTER JOIN
                      dbo.tc_trans_kasir LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.tc_registrasi LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.mt_perusahaan_tagih_v ON dbo.tc_trans_kasir.kode_perusahaan = dbo.mt_perusahaan_tagih_v.kode_perusahaan ON 
                      dbo.mt_pasien_penunjang.no_pm = dbo.tc_trans_kasir.no_mr LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.nk_perusahaan > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_nk_tagihan_asuransi]");
    }
};
