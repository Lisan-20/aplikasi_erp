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
        DB::statement("CREATE VIEW dbo.bedah_level_4_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.bedah_level_3_v.nama_tarif AS level_3, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, 
                      dbo.bedah_level_3_v.kode_tarif AS kode
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.bedah_level_3_v ON dbo.mt_master_tarif.referensi = dbo.bedah_level_3_v.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bedah_level_4_v]");
    }
};
