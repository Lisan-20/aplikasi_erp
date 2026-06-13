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
        DB::statement("CREATE VIEW dbo.waitinglist_v
AS
SELECT        dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.gd_daftar_antrian_v.nama_pasien, dbo.tc_emr_form.kode_rm, dbo.gd_daftar_antrian_v.status_batal, dbo.gd_daftar_antrian_v.status_keluar, 
                         dbo.tc_emr_form.tgl_update, dbo.gd_daftar_antrian_v.kode_kelompok, dbo.gd_daftar_antrian_v.kode_perusahaan
FROM            dbo.gd_daftar_antrian_v INNER JOIN
                         dbo.tc_kunjungan ON dbo.gd_daftar_antrian_v.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                         dbo.tc_emr_form ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_emr_form.no_kunjungan
WHERE        (dbo.tc_emr_form.kode_rm = 65) AND (dbo.gd_daftar_antrian_v.status_batal IS NULL) AND (dbo.gd_daftar_antrian_v.status_keluar IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [waitinglist_v]");
    }
};
