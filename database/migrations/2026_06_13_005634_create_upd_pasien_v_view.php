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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_pasien_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, 
                      dbo.mt_master_pasien_08.kode_kelompok AS kode_kelompok_lama, dbo.mt_master_pasien_08.kode_perusahaan AS kode_perusahaan_lama
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.mt_master_pasien_08 ON dbo.mt_master_pasien.no_mr = dbo.mt_master_pasien_08.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_pasien_v]");
    }
};
