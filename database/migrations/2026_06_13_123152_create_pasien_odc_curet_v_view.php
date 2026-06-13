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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_odc_curet_v
AS
SELECT     bulan_plg, tahun_plg, nama_tarif, no_mr, 3 AS kode_klasifikasi, nama_pasien
FROM         dbo.pasien_ok_vk_v
WHERE     (nama_tarif LIKE '%odc%') OR
                      (nama_tarif LIKE '%curet%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_odc_curet_v]");
    }
};
