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
        DB::statement("CREATE OR ALTER VIEW dbo.Back_tarif_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_detail.kode_master_tarif_detail, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.kode_tgl_tarif, 
                      dbo.mt_master_tarif_detail.kode_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif.nama_tarif, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_bagian.validasi, dbo.mt_bagian.status_aktif
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mt_bagian.validasi = '0300') AND (dbo.mt_bagian.status_aktif = 1)
ORDER BY dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.kode_tindakan, dbo.mt_klas.nama_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [Back_tarif_v]");
    }
};
