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
        DB::statement("CREATE OR ALTER VIEW dbo.jatah_cuti_v
AS
SELECT     dbo.tc_jatah_cuti.id_tc_jatah_cuti, dbo.tc_jatah_cuti.npp, dbo.tc_jatah_cuti.jatah_cuti, dbo.tc_jatah_cuti.tahun, dbo.dd_jenis_cuti.jenis_cuti, 
                      dbo.tc_jatah_cuti.id_dd_jenis_cuti
FROM         dbo.dd_jenis_cuti INNER JOIN
                      dbo.tc_jatah_cuti ON dbo.dd_jenis_cuti.id_dd_jenis_cuti = dbo.tc_jatah_cuti.id_dd_jenis_cuti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jatah_cuti_v]");
    }
};
