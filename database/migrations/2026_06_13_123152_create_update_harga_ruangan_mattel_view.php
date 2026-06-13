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
        DB::statement("CREATE OR ALTER VIEW dbo.update_harga_ruangan_mattel
AS
SELECT     dbo.mt_ruangan.kode_ruangan, dbo.mt_ruangan.kode_klas, dbo.mt_master_tarif_ruangan.harga_r, dbo.mt_master_tarif_ruangan.harga_mattel
FROM         dbo.mt_ruangan INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.mt_ruangan.kode_ruangan = dbo.mt_master_tarif_ruangan.kode_ruangan
WHERE     (dbo.mt_ruangan.kode_klas = 7)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_harga_ruangan_mattel]");
    }
};
