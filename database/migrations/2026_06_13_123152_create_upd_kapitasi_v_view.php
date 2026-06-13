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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kapitasi_v
AS
SELECT     dbo.penunjang$.kode_tarif, dbo.penunjang$.nama_tindakan, dbo.penunjang$.total, dbo.penunjang$.bill_rs, dbo.penunjang$.bill_dr, dbo.penunjang$.klas, 
                      dbo.mt_master_tarif_detail.total_kapitasi, dbo.mt_master_tarif_detail.bill_dr2_kapitasi, dbo.mt_master_tarif_detail.bill_dr1_kapitasi, 
                      dbo.mt_master_tarif_detail.bill_rs_kapitasi
FROM         dbo.penunjang$ INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.penunjang$.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kapitasi_v]");
    }
};
