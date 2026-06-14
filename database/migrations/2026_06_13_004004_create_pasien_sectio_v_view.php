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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_sectio_v
AS
SELECT     bulan_plg, tahun_plg, nama_tarif, 2 AS kode_klasifikasi, no_mr
FROM         dbo.pasien_ok_vk_v
WHERE     (nama_tarif LIKE '%sectio%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_sectio_v]");
    }
};
