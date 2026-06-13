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
        DB::statement("CREATE VIEW dbo.up_tarif_2019_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif.nama_tarif, 
                      dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.total_pt, dbo.mt_master_tarif_detail.total_ass, dbo.mt_master_tarif.jenis_tindakan, dbo.mt_master_tarif_detail.bill_dr1_pt, 
                      dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.total * 40 / 100 AS bill_dr_u, dbo.mt_master_tarif_detail.total * 60 / 100 AS bill_rs_u, dbo.mt_master_tarif_detail.bill_rs_pt, 
                      dbo.mt_master_tarif_detail.bill_rs_ass
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian = '011101') AND (dbo.mt_master_tarif.kode_tarif <> 111010101)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_tarif_2019_v]");
    }
};
