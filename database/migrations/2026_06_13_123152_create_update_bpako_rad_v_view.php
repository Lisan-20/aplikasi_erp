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
        DB::statement("CREATE VIEW dbo.update_bpako_rad_v
AS
SELECT     dbo.pm_mt_bpako.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.pm_mt_bpako.kode_brg, dbo.mt_barang.nama_brg
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.pm_mt_bpako ON dbo.mt_master_tarif.kode_tarif = dbo.pm_mt_bpako.kode_tarif INNER JOIN
                      dbo.mt_barang ON dbo.pm_mt_bpako.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bpako_rad_v]");
    }
};
