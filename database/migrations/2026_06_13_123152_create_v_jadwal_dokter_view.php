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
        DB::statement("CREATE VIEW dbo.v_jadwal_dokter
AS
SELECT     TOP (100) PERCENT dbo.mt_jadwal_dokter.kode_dokter, dbo.mt_jadwal_dokter.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.status, 
                      dbo.mt_jadwal_dokter.range_hari, dbo.mt_jadwal_dokter.senin, dbo.mt_jadwal_dokter.selasa, dbo.mt_jadwal_dokter.rabu, dbo.mt_jadwal_dokter.kamis, dbo.mt_jadwal_dokter.jumat, 
                      dbo.mt_jadwal_dokter.sabtu, dbo.mt_jadwal_dokter.minggu, dbo.mt_jadwal_dokter.status AS status_dr, dbo.mt_jadwal_dokter.id_mt_jadwal_dokter, { fn HOUR(dbo.mt_jadwal_dokter.jam_mulai) 
                      } AS jam_mulai, { fn HOUR(dbo.mt_jadwal_dokter.jam_akhir) } AS jam_akhir
FROM         dbo.mt_jadwal_dokter INNER JOIN
                      dbo.mt_bagian ON dbo.mt_jadwal_dokter.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.mt_jadwal_dokter.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.mt_karyawan.status = '0') OR
                      (dbo.mt_karyawan.status IS NULL)
ORDER BY dbo.mt_karyawan.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jadwal_dokter]");
    }
};
