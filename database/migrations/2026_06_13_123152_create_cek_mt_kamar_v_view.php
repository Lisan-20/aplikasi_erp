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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_mt_kamar_v
AS
SELECT     dbo.mt_master_tarif_ruangan.kode_bagian, dbo.mt_master_tarif_ruangan.kode_klas, dbo.mt_master_tarif_ruangan.harga_r, 
                      dbo.mt_master_tarif_ruangan.kode_ruangan, dbo.mt_ruangan.no_bed
FROM         dbo.mt_master_tarif_ruangan FULL OUTER JOIN
                      dbo.mt_ruangan ON dbo.mt_master_tarif_ruangan.kode_ruangan = dbo.mt_ruangan.no_bed
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_mt_kamar_v]");
    }
};
