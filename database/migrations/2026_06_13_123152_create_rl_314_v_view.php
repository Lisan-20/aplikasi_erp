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
        DB::statement("CREATE VIEW dbo.rl_314_v
AS
SELECT     dbo.mt_karyawan.kode_spesialisasi, dbo.mt_spesialisasi_dokter.nama_spesialisasi, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, COUNT(dbo.tc_registrasi.no_registrasi) AS jml, dbo.tc_registrasi.id_dc_asal_pasien, 
                      dbo.dc_asal_pasien.asal_pasien, dbo.tc_registrasi.tgl_jam_masuk
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.mt_spesialisasi_dokter ON dbo.mt_karyawan.kode_spesialisasi = dbo.mt_spesialisasi_dokter.kode_spesialisasi INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_karyawan.kode_dokter = dbo.tc_registrasi.kode_dokter LEFT OUTER JOIN
                      dbo.dc_asal_pasien ON dbo.tc_registrasi.id_dc_asal_pasien = dbo.dc_asal_pasien.id_dc_asal_pasien
GROUP BY dbo.mt_karyawan.kode_spesialisasi, dbo.mt_spesialisasi_dokter.nama_spesialisasi, YEAR(dbo.tc_registrasi.tgl_jam_masuk), 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.id_dc_asal_pasien, dbo.dc_asal_pasien.asal_pasien, 
                      dbo.tc_registrasi.tgl_jam_masuk
HAVING      (NOT (dbo.mt_karyawan.kode_spesialisasi IN (1, 29))) AND (dbo.tc_registrasi.status_registrasi IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_314_v]");
    }
};
