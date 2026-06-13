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
        DB::statement("CREATE VIEW dbo.upd_tarif_nayaka_v
AS
SELECT     dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.total_inhealth, 
                      dbo.mt_master_tarif_detail.bill_dr2_inhealth, dbo.mt_master_tarif_detail.bill_dr1_inhealth, dbo.mt_master_tarif_detail.bill_rs_inhealth, 
                      dbo.mt_master_tarif.nama_tarif
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian LIKE '0305%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_nayaka_v]");
    }
};
