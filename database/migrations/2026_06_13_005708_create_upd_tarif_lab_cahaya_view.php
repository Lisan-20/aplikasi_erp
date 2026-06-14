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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_tarif_lab_cahaya
AS
SELECT     dbo.tarif_lab_cahaya.harga, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs_cahaya, 
                      dbo.mt_master_tarif_detail.total_cahaya, dbo.mt_master_tarif.nama_tarif
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.tarif_lab_cahaya ON dbo.mt_master_tarif.nama_tarif = dbo.tarif_lab_cahaya.Tindakan
WHERE     (dbo.mt_master_tarif.kode_bagian = '050101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_lab_cahaya]");
    }
};
