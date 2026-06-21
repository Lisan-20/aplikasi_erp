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
        DB::statement("CREATE OR ALTER VIEW dbo.v_dokter_apm
AS
SELECT     dbo.mt_dokter_bagian.kd_bagian, dbo.mt_dokter_bagian.kode_dokter, dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM         dbo.mt_dokter_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.mt_dokter_bagian.kode_dokter = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_dokter_apm]");
    }
};
