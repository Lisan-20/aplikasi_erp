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
        DB::statement("CREATE VIEW dbo.mt_detail_bedah_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, dbo.mt_master_tarif_detail_bedah.bill_dr2, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr3, dbo.mt_master_tarif_detail_bedah.no_urut, dbo.mt_keterangan_bedah.keterangan_bedah, 
                      dbo.mt_master_tarif_detail_bedah.detail
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif AND 
                      dbo.mt_master_tarif_detail.kode_klas = dbo.mt_master_tarif_detail_bedah.kode_klas INNER JOIN
                      dbo.mt_keterangan_bedah ON dbo.mt_master_tarif_detail_bedah.no_urut = dbo.mt_keterangan_bedah.no_urut
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_bedah.no_urut
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_detail_bedah_v]");
    }
};
