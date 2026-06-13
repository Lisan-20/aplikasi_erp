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
        DB::statement("CREATE OR ALTER VIEW dbo.rg_jadwal_dokter_v
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.kode_dokter, dbo.mt_bagian.nama_bagian, dbo.mt_dokter_v.kd_bagian
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.mt_dokter_v ON dbo.mt_karyawan.kode_dokter = dbo.mt_dokter_v.kode_dokter INNER JOIN
                      dbo.mt_bagian ON dbo.mt_dokter_v.kd_bagian = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_jadwal_dokter_v]");
    }
};
