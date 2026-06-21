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
        DB::statement("CREATE OR ALTER VIEW dbo.update_kelompok_v
AS
SELECT     dbo.mt_perusahaan.flag, dbo.mt_master_pasien.kode_kelompok
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_master_pasien.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.mt_perusahaan.flag = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kelompok_v]");
    }
};
