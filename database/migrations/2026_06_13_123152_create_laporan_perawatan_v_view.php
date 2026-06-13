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
        DB::statement("CREATE VIEW dbo.laporan_perawatan_v
AS
SELECT     dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, YEAR(dbo.tc_kunjungan.tgl_keluar) 
                      AS thn, dbo.tc_kunjungan.kode_dokter
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_perawatan_v]");
    }
};
