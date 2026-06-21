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
        DB::statement("CREATE OR ALTER VIEW dbo.tarif_labhard_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.total_hardlent, 
                      dbo.mt_master_tarif_detail.bill_rs_hardlent, dbo.mt_master_tarif.kode_bagian
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian = '050101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_labhard_v]");
    }
};
