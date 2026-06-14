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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rujukan_poli_v
AS
SELECT     dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.status_batal, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_kunjungan.no_registrasi, dbo.pl_tc_poli.status_periksa, dbo.mt_master_pasien.no_mr, 
                      dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_registrasi.id_dc_sub_asal_pasien
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_kunjungan.no_registrasi, dbo.pl_tc_poli.status_periksa, dbo.tc_kunjungan.kode_bagian_asal, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, 
                      dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_registrasi.id_dc_sub_asal_pasien
HAVING      (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '01%') AND (dbo.pl_tc_poli.status_periksa = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rujukan_poli_v]");
    }
};
