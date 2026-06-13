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
        DB::statement("CREATE VIEW dbo.lap_penyakit_lama_v
AS
SELECT     dbo.lap_10_besar_penyakit_v.kode_bagian, dbo.tc_registrasi.kode_kelompok, COUNT(dbo.tc_registrasi.stat_pasien) AS lama, 
                      dbo.lap_10_besar_penyakit_v.kode_icd, dbo.tc_registrasi.kode_perusahaan, MONTH(dbo.tc_registrasi.tgl_jam_keluar) AS bulan, 
                      YEAR(dbo.tc_registrasi.tgl_jam_keluar) AS tahun
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.lap_10_besar_penyakit_v ON dbo.tc_registrasi.no_registrasi = dbo.lap_10_besar_penyakit_v.no_registrasi
WHERE     (dbo.tc_registrasi.stat_pasien = 'Lama')
GROUP BY dbo.lap_10_besar_penyakit_v.kode_bagian, dbo.tc_registrasi.kode_kelompok, dbo.lap_10_besar_penyakit_v.kode_icd, dbo.tc_registrasi.kode_perusahaan, 
                      YEAR(dbo.tc_registrasi.tgl_jam_keluar), MONTH(dbo.tc_registrasi.tgl_jam_keluar)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_penyakit_lama_v]");
    }
};
