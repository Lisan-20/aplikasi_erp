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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_bpjs_lagi_v
AS
SELECT        TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs_bpjs, 
                         dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.total_bpjs, dbo.mt_bagian.nama_bagian, dbo.mt_master_tarif.jenis_tindakan
FROM            dbo.mt_master_tarif INNER JOIN
                         dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian RIGHT OUTER JOIN
                         dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE        (dbo.mt_master_tarif_detail.bill_dr1_bpjs = 50000) AND (dbo.mt_master_tarif.jenis_tindakan = 3)
ORDER BY dbo.mt_bagian.nama_bagian, dbo.mt_master_tarif_detail.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bpjs_lagi_v]");
    }
};
