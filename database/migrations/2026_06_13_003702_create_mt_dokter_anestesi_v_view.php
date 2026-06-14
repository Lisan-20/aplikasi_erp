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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_dokter_anestesi_v
AS
SELECT     dbo.tc_bedah.no_registrasi, dbo.tc_bedah.kode_dr_anestesi AS kode_dokter, dbo.mt_karyawan.nama_pegawai, dbo.tc_bedah.kode_tarif, dbo.tc_bedah.nama_tindakan
FROM         dbo.tc_bedah INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_bedah.kode_dr_anestesi = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_bedah.kode_dr_anestesi IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_dokter_anestesi_v]");
    }
};
