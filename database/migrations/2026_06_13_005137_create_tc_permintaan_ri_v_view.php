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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_permintaan_ri_v
AS
SELECT     dbo.tc_emr_form.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.kode_rm, dbo.tc_emr_form.tgl_update, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_emr_form.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.kode_dokter, dbo.tc_kunjungan.tgl_keluar
FROM         dbo.tc_emr_form INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_emr_form.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_emr_form.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_emr_form.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
WHERE     (dbo.tc_emr_form.kode_rm = 65) AND (dbo.tc_kunjungan.tgl_keluar IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_permintaan_ri_v]");
    }
};
