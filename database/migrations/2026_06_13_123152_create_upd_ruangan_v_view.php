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
        DB::statement("CREATE VIEW dbo.upd_ruangan_v
AS
SELECT     dbo.mt_master_tarif_ruangan.kode_bagian, dbo.mt_master_tarif_ruangan.kode_klas, dbo.mt_master_tarif_ruangan.kode_ruangan, 
                      dbo.mt_ruangan_baru.kode_ruangan AS [ruangan baru], dbo.mt_ruangan_baru.no_kamar
FROM         dbo.mt_ruangan_baru INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.mt_ruangan_baru.kode_bagian = dbo.mt_master_tarif_ruangan.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ruangan_v]");
    }
};
