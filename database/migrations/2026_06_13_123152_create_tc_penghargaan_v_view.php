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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_penghargaan_v
AS
SELECT     dbo.mt_karyawan.npp, dbo.mt_karyawan.nama_pegawai, dbo.tc_jasa.penghargaan, dbo.tc_jasa.tgl_jasa, dbo.tc_jasa.lembaga, dbo.tc_jasa.no_piagam, 
                      dbo.tc_jasa.status, dbo.tc_jasa.id_tc_jasa
FROM         dbo.tc_jasa INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_jasa.npp = dbo.mt_karyawan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penghargaan_v]");
    }
};
