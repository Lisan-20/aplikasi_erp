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
        DB::statement("CREATE VIEW dbo.kapitasi_ri_v
AS
SELECT     dbo.ranap$.kode_tarif, dbo.ranap$.nama_tindakan, dbo.ranap$.total, dbo.ranap$.bill_rs, dbo.ranap$.bill_dr, dbo.ranap$.klas, 
                      dbo.mt_master_tarif_detail.bill_rs_kapitasi, dbo.mt_master_tarif_detail.bill_dr1_kapitasi, dbo.mt_master_tarif_detail.bill_dr2_kapitasi, 
                      dbo.mt_master_tarif_detail.total_kapitasi
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.ranap$ ON dbo.mt_master_tarif_detail.kode_tarif = dbo.ranap$.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kapitasi_ri_v]");
    }
};
