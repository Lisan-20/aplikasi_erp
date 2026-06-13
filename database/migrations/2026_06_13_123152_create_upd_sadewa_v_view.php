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
        DB::statement("CREATE VIEW dbo.upd_sadewa_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_ruangan.kode_bagian, dbo.mt_ruangan.no_kamar, dbo.mt_ruangan.no_bed, dbo.mt_ruangan.kode_klas, dbo.mt_master_tarif_ruangan.kode_klas AS Kelas, 
                      dbo.mt_ruangan.kode_ruangan, dbo.mt_master_tarif_ruangan.kode_ruangan AS ruangan
FROM         dbo.mt_master_tarif_ruangan INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_master_tarif_ruangan.kode_ruangan = dbo.mt_ruangan.kode_ruangan
WHERE     (dbo.mt_master_tarif_ruangan.kode_bagian = '030109')
ORDER BY dbo.mt_ruangan.no_kamar
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_sadewa_v]");
    }
};
