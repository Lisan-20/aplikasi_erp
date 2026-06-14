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
        DB::statement("CREATE OR ALTER VIEW dbo.update_kode_mt_pasein_v
AS
SELECT     dbo.mt_master_pasien.kode_kelompok, dbo.update_mt_pasien_v.kode_kelompok AS kode, 85 AS kd_per, dbo.update_mt_pasien_v.Instansi, 
                      dbo.mt_master_pasien.kode_perusahaan
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.update_mt_pasien_v ON dbo.mt_master_pasien.no_mr = dbo.update_mt_pasien_v.NoMR
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_mt_pasein_v]");
    }
};
