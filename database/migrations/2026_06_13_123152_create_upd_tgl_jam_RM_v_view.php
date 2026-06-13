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
        DB::statement("CREATE VIEW dbo.upd_tgl_jam_RM_v
AS
SELECT     TOP (100) PERCENT dbo.lap_rm_per_icd10_v.bulan, dbo.lap_rm_per_icd10_v.tahun, dbo.lap_rm_per_icd10_v.kode_icd, dbo.lap_rm_per_icd10_v.tipe_rl, 
                      dbo.lap_rm_per_icd10_v.kobag, dbo.lap_rm_per_icd10_v.kode_bagian, dbo.lap_rm_per_icd10_v.nama_icd_10, dbo.lap_rm_per_icd10_v.no_registrasi, 
                      dbo.lap_rm_per_icd10_v.no_mr, dbo.lap_rm_per_icd10_v.nama_pasien, dbo.lap_rm_per_icd10_v.nama_bagian, dbo.lap_rm_per_icd10_v.diagnosa, 
                      dbo.lap_rm_per_icd10_v.tgl_jam, dbo.lap_rm_per_icd10_v.pekerjaan, dbo.lap_rm_per_icd10_v.kode_agama, dbo.lap_rm_per_icd10_v.almt_ttp_pasien, 
                      dbo.lap_rm_per_icd10_v.umur_pasien, dbo.lap_rm_per_icd10_v.kota, dbo.lap_rm_per_icd10_v.jen_kelamin, dbo.lap_rm_per_icd10_v.tgl_lhr, 
                      dbo.lap_rm_per_icd10_v.kode_kelompok, dbo.lap_rm_per_icd10_v.umur, dbo.tc_kunjungan.tgl_keluar
FROM         dbo.lap_rm_per_icd10_v INNER JOIN
                      dbo.tc_kunjungan ON dbo.lap_rm_per_icd10_v.no_registrasi = dbo.tc_kunjungan.no_registrasi
WHERE     (dbo.lap_rm_per_icd10_v.tipe_rl = 'B') AND (dbo.lap_rm_per_icd10_v.tgl_jam IS NULL)
ORDER BY dbo.lap_rm_per_icd10_v.tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tgl_jam_RM_v]");
    }
};
