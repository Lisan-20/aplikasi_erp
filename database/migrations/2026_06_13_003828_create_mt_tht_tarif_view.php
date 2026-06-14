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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tht_tarif
AS
SELECT     dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif_detail_bedah.bill_dr1, dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.mt_master_tarif_detail_bedah.total_bpjs, dbo.Thtbaru.dr, dbo.Thtbaru.rs, dbo.mt_master_tarif_detail_bedah.bill_rs
FROM         dbo.mt_master_tarif_detail_bedah INNER JOIN
                      dbo.Thtbaru ON dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.Thtbaru.kode_tarif AND dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.Thtbaru.kode_kelas AND 
                      dbo.mt_master_tarif_detail_bedah.no_urut = dbo.Thtbaru.no_urut
WHERE     (dbo.Thtbaru.dr > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tht_tarif]");
    }
};
