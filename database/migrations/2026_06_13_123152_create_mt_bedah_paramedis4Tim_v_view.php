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
        DB::statement("CREATE VIEW dbo.mt_bedah_paramedis4Tim_v
AS
SELECT     dbo.tc_bedah_tim.no_registrasi, dbo.mt_karyawan.nama_pegawai, dbo.tc_bedah_tim.kode_tarif, dbo.tc_bedah_tim.nama_tindakan, dbo.tc_bedah_tim.asisten_op_4 AS kode_paramedis
FROM         dbo.tc_bedah_tim INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_bedah_tim.asisten_op_4 = dbo.mt_karyawan.kode_paramedis
WHERE     (dbo.tc_bedah_tim.asisten_op_4 IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bedah_paramedis4Tim_v]");
    }
};
