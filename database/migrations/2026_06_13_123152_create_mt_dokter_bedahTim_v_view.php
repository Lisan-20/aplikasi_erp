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
        DB::statement("CREATE VIEW dbo.mt_dokter_bedahTim_v
AS
SELECT     dbo.tc_bedah_tim.no_registrasi, dbo.tc_bedah_tim.kode_dr_bedah AS kode_dokter, dbo.mt_karyawan.nama_pegawai, dbo.tc_bedah_tim.kode_tarif, dbo.tc_bedah_tim.nama_tindakan
FROM         dbo.tc_bedah_tim INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_bedah_tim.kode_dr_bedah = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_bedah_tim.kode_dr_bedah IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_dokter_bedahTim_v]");
    }
};
