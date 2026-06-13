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
        DB::statement("CREATE VIEW dbo.proses_gaji_gabung_v
AS
SELECT     dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, dbo.mt_periode_gaji.id_periode_gaji, dbo.mt_periode_gaji.status_periode_gaji, 
                      CASE WHEN dbo.proses_gaji_pokok_v.nominal_gaji_pokok IS NULL THEN 0 ELSE dbo.proses_gaji_pokok_v.nominal_gaji_pokok END AS nominal_gaji_pokok, 
                      CASE WHEN nominal_tunjangan IS NULL THEN 0 ELSE nominal_tunjangan END AS nominal_tunjangan, CASE WHEN nominal_bonus IS NULL THEN 0 ELSE nominal_bonus END AS nominal_bonus, 
                      CASE WHEN nominal_potongan IS NULL THEN 0 ELSE nominal_potongan END AS nominal_potongan, dbo.mt_periode_gaji.periode_gaji, dbo.penempatan_bagian_v.kode_bagian, 
                      dbo.penempatan_bagian_v.nama_bagian, dbo.mt_periode_gaji.periode_awal, dbo.mt_periode_gaji.periode_akhir, dbo.mt_karyawan.kode_dokter
FROM         dbo.mt_karyawan LEFT OUTER JOIN
                      dbo.penempatan_bagian_v ON dbo.mt_karyawan.npp = dbo.penempatan_bagian_v.npp LEFT OUTER JOIN
                      dbo.proses_gaji_pokok_v ON dbo.mt_karyawan.npp = dbo.proses_gaji_pokok_v.npp LEFT OUTER JOIN
                      dbo.proses_gaji_potongan_v ON dbo.mt_karyawan.npp = dbo.proses_gaji_potongan_v.npp LEFT OUTER JOIN
                      dbo.proses_gaji_bonus_v ON dbo.mt_karyawan.npp = dbo.proses_gaji_bonus_v.npp LEFT OUTER JOIN
                      dbo.proses_gaji_tunjangan_v ON dbo.mt_karyawan.npp = dbo.proses_gaji_tunjangan_v.npp CROSS JOIN
                      dbo.mt_periode_gaji
WHERE     (dbo.mt_karyawan.id_status IN (1, 2, 5))
GROUP BY dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, dbo.mt_periode_gaji.id_periode_gaji, dbo.mt_periode_gaji.status_periode_gaji, dbo.mt_periode_gaji.periode_gaji, 
                      dbo.penempatan_bagian_v.kode_bagian, dbo.penempatan_bagian_v.nama_bagian, CASE WHEN dbo.proses_gaji_pokok_v.nominal_gaji_pokok IS NULL 
                      THEN 0 ELSE dbo.proses_gaji_pokok_v.nominal_gaji_pokok END, CASE WHEN nominal_tunjangan IS NULL THEN 0 ELSE nominal_tunjangan END, CASE WHEN nominal_bonus IS NULL 
                      THEN 0 ELSE nominal_bonus END, CASE WHEN nominal_potongan IS NULL THEN 0 ELSE nominal_potongan END, dbo.mt_periode_gaji.periode_awal, dbo.mt_periode_gaji.periode_akhir, 
                      dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_gaji_gabung_v]");
    }
};
