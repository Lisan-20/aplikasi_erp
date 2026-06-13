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
        DB::statement("CREATE VIEW dbo.pasien_sc_paket_v
AS
SELECT     bulan_plg, tahun_plg, nama_tarif, no_mr, 1 AS kode_klasifikasi
FROM         dbo.pasien_ok_vk_v
WHERE     (nama_tarif LIKE '%partus%') OR
                      (nama_tarif LIKE '%2dc%') OR
                      (nama_tarif LIKE '%3dc%') OR
                      (nama_tarif LIKE '%manual%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_sc_paket_v]");
    }
};
