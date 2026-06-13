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
        DB::statement("CREATE VIEW dbo.pm_bpako_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_barang.nama_brg, 
                      dbo.mt_barang.satuan_besar, dbo.mt_barang.satuan_kecil, dbo.pm_mt_bpako.id_pm_mt_bpako, dbo.pm_mt_bpako.volume
FROM         dbo.pm_mt_bpako INNER JOIN
                      dbo.mt_master_tarif ON dbo.pm_mt_bpako.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_barang ON dbo.pm_mt_bpako.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_bpako_v]");
    }
};
