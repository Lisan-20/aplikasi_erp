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
        DB::statement("CREATE VIEW dbo.mt_bedah_paramedis1_v
AS
SELECT     dbo.tc_bedah.no_registrasi, dbo.mt_karyawan.nama_pegawai, dbo.tc_bedah.kode_tarif, dbo.tc_bedah.nama_tindakan, dbo.tc_bedah.asisten_op_1 AS kode_paramedis
FROM         dbo.tc_bedah INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_bedah.asisten_op_1 = dbo.mt_karyawan.kode_paramedis
WHERE     (dbo.tc_bedah.asisten_op_1 IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bedah_paramedis1_v]");
    }
};
