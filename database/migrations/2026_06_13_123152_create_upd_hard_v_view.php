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
        DB::statement("CREATE VIEW dbo.upd_hard_v
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.total_hardlent, dbo.mt_master_tarif_detail.kode_klas, dbo.updatelab_hard.I
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.updatelab_hard ON dbo.mt_master_tarif.nama_tarif = dbo.updatelab_hard.nama_tindakan
WHERE     (dbo.mt_master_tarif_detail.kode_klas = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_hard_v]");
    }
};
