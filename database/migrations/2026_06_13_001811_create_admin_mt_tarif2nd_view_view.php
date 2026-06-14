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
        DB::statement("CREATE OR ALTER VIEW dbo.admin_mt_tarif2nd_view
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, 
                      dbo.mt_master_tarif.referensi, dbo.mt_master_tarif.paket_askes, dbo.mt_master_tarif.jenis_tindakan
FROM         dbo.admin_mt_tarif_view INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.admin_mt_tarif_view.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif RIGHT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.admin_mt_tarif_view.kode_tarif = dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_mt_tarif2nd_view]");
    }
};
