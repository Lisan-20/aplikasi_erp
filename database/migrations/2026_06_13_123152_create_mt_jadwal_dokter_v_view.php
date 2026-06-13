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
        DB::statement("CREATE VIEW dbo.mt_jadwal_dokter_v
AS
SELECT     dbo.mt_spesialisasi_dokter.nama_spesialisasi, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.kode_dokter, dbo.mt_karyawan.kode_spesialisasi, dbo.mt_jadwal_dokter.jam_mulai, 
                      dbo.mt_jadwal_dokter.jam_akhir, dbo.mt_jadwal_dokter.range_hari, dbo.mt_bagian.kode_bagian, dbo.mt_jadwal_dokter.id_mt_jadwal_dokter, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_jadwal_dokter.keterangan
FROM         dbo.mt_karyawan LEFT OUTER JOIN
                      dbo.mt_spesialisasi_dokter ON dbo.mt_karyawan.kode_spesialisasi = dbo.mt_spesialisasi_dokter.kode_spesialisasi LEFT OUTER JOIN
                      dbo.mt_bagian RIGHT OUTER JOIN
                      dbo.mt_jadwal_dokter ON dbo.mt_bagian.kode_bagian = dbo.mt_jadwal_dokter.kode_bagian ON dbo.mt_karyawan.kode_dokter = dbo.mt_jadwal_dokter.kode_dokter
WHERE     (NOT (dbo.mt_karyawan.kode_dokter IS NULL))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_jadwal_dokter_v]");
    }
};
