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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_pasien_bpjs_alert_v
AS
SELECT     TOP (100) PERCENT a.no_mr, a.no_registrasi, a.no_kunjungan, a.kode_ri, a.nama_pasien, a.kode_ruangan, a.bag_pas, a.kelas_pas, a.tgl_masuk, a.dr_merawat, a.asal_pasien, a.bag_ibu, 
                      a.kelas_ibu, a.gol_darah, a.alergi, a.tgl_lhr, a.jen_kelamin, a.almt_ttp_pasien, a.tgl_keluar, a.status_pulang, a.status_cuti, a.status_registrasi, a.kode_perusahaan, a.kode_kelompok, a.no_jkn, 
                      a.kode_plafon, a.plafon_bpjs, a.diagnosa_awal, a.icd10, a.icd9, a.status_batal, a.batal, a.batal_ri, a.noSep, a.noKartuPeserta, a.alos, a.no_jaminan, a.no_sjp, b.nama_bagian
FROM         dbo.ri_cari_pasien_jkn_v AS a INNER JOIN
                      dbo.mt_bagian AS b ON a.bag_pas = b.kode_bagian
WHERE     (a.bag_pas NOT IN (030901)) AND (a.kode_kelompok IN (8, 9, 11, 12))
ORDER BY a.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pasien_bpjs_alert_v]");
    }
};
