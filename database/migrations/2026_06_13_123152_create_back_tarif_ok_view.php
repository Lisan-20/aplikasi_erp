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
        DB::statement("CREATE VIEW dbo.back_tarif_ok
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.referensi, 
                      dbo.mt_master_tarif.jenis_tindakan, dbo.mt_tarif_v.kode_klas, dbo.mt_tarif_v.bill_rs, dbo.mt_tarif_v.bill_dr1, dbo.mt_tarif_v.bill_dr2, 
                      dbo.mt_tarif_v.kode_master_tarif_detail, dbo.mt_tarif_v.nama_klas, dbo.mt_tarif_v.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_master_tarif.kode_tindakan, 
                      dbo.mt_bagian.validasi, dbo.mt_bagian.status_aktif
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_tarif_v ON dbo.mt_bagian.kode_bagian = dbo.mt_tarif_v.kode_bagian INNER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_tarif_v.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif RIGHT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.mt_tarif_v.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_bagian.status_aktif = 1) AND (dbo.mt_tarif_v.kode_bagian = '020101')
ORDER BY dbo.mt_tarif_v.kode_bagian, dbo.mt_master_tarif.nama_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [back_tarif_ok]");
    }
};
