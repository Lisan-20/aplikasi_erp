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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_cuti_v
AS
SELECT     dbo.dd_jenis_cuti.jenis_cuti, dbo.tc_jatah_cuti.id_dd_jenis_cuti, dbo.tc_jatah_cuti.jatah_cuti, dbo.tc_jatah_cuti.npp, dbo.tc_cuti.tgl_pengajuan, 
                      dbo.tc_cuti.tgl_mulai_cuti, dbo.tc_cuti.tgl_akhir_cuti, dbo.tc_cuti.jumlah_hari, dbo.tc_jatah_cuti.tahun, dbo.tc_cuti.id_htc_cuti
FROM         dbo.dd_jenis_cuti INNER JOIN
                      dbo.tc_jatah_cuti ON dbo.dd_jenis_cuti.id_dd_jenis_cuti = dbo.tc_jatah_cuti.id_dd_jenis_cuti LEFT OUTER JOIN
                      dbo.tc_cuti ON dbo.tc_jatah_cuti.npp = dbo.tc_cuti.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_cuti_v]");
    }
};
