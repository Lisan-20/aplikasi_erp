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
        DB::statement("CREATE OR ALTER VIEW dbo.tarif_bedah_level5_vk_v
AS
SELECT     kode_tarif, kode_tindakan, nama_tarif, referensi, tingkatan, kode_bagian
FROM         dbo.mt_master_tarif
GROUP BY kode_tarif, kode_tindakan, nama_tarif, tingkatan, kode_bagian, referensi
HAVING      (kode_bagian = '030501') AND (tingkatan = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_bedah_level5_vk_v]");
    }
};
