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
        DB::statement("CREATE OR ALTER VIEW dbo.bulanan_dokter
AS
SELECT     dbo.lap_dokter_bulanan_v.thn, dbo.lap_dokter_bulanan_v.bln, dbo.lap_dokter_bulanan_v.tgl, dbo.lap_dokter_bulanan_v.jen_kelamin, 
                      dbo.lap_dokter_bulanan_v.jml_jen_kelamin, dbo.lap_dokter_bulanan_v.kode_kelompok, dbo.lap_dokter_bulanan_v.jml_kode_kelompok, 
                      dbo.lap_dokter_bulanan_v.stat_pasien, dbo.lap_dokter_bulanan_v.jml_stat_pasien, dbo.lap_dokter_bulanan_v.kode_perusahaan, dbo.lap_dokter_bulanan_v.umur, 
                      dbo.lap_dokter_bulanan_v.kode_dokter, dbo.lap_dokter_bulanan_v.kode_bagian_tujuan, dbo.lap_dokter_bulanan_v.no_kunjungan, 
                      dbo.lap_dokter_bulanan_v.no_registrasi
FROM         dbo.lap_dokter_bulanan_v INNER JOIN
                      dbo.registrasi_inap_v ON dbo.lap_dokter_bulanan_v.no_registrasi = dbo.registrasi_inap_v.no_registrasi
GROUP BY dbo.lap_dokter_bulanan_v.thn, dbo.lap_dokter_bulanan_v.bln, dbo.lap_dokter_bulanan_v.tgl, dbo.lap_dokter_bulanan_v.jen_kelamin, 
                      dbo.lap_dokter_bulanan_v.jml_jen_kelamin, dbo.lap_dokter_bulanan_v.kode_kelompok, dbo.lap_dokter_bulanan_v.jml_kode_kelompok, 
                      dbo.lap_dokter_bulanan_v.stat_pasien, dbo.lap_dokter_bulanan_v.jml_stat_pasien, dbo.lap_dokter_bulanan_v.kode_perusahaan, dbo.lap_dokter_bulanan_v.umur, 
                      dbo.lap_dokter_bulanan_v.kode_dokter, dbo.lap_dokter_bulanan_v.kode_bagian_tujuan, dbo.lap_dokter_bulanan_v.no_kunjungan, 
                      dbo.lap_dokter_bulanan_v.no_registrasi
HAVING      (dbo.lap_dokter_bulanan_v.kode_bagian_tujuan = '020101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bulanan_dokter]");
    }
};
