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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_mcu_view
AS
SELECT     dbo.mt_master_tarif.nama_tarif AS tindakan, dbo.mt_mcu_tarif_detail.kode_mt_mcu, dbo.mt_mcu_tarif_detail.kode_tarif, dbo.mt_mcu_tarif_detail.kode_referensi, 
                      dbo.mt_mcu_tarif_detail.kode_bagian, dbo.mt_mcu_tarif_detail.bill_rs, dbo.mt_mcu_tarif_detail.bill_dr, dbo.mt_mcu_tarif_detail.total, dbo.mt_mcu_tarif_detail.kode_tgl_tarif, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_mcu_tarif_detail.id_mt_mcu_detail, dbo.mt_master_tarif.jenis_tindakan, mt_master_tarif_1.nama_tarif, 16 AS kode_klas
FROM         dbo.mt_mcu_tarif_detail INNER JOIN
                      dbo.mt_bagian ON dbo.mt_mcu_tarif_detail.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_mcu_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_mcu_tarif_detail.kode_referensi = mt_master_tarif_1.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_mcu_view]");
    }
};
