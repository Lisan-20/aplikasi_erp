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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_tarif_baru_v
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_bagian, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs, 
                      dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, 
                      dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs, 
                      dbo.mt_master_tarif_detail.total_pt, dbo.mt_master_tarif_detail.total_ass, dbo.mt_master_tarif_detail.total_bpjs
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mt_master_tarif_detail.kode_klas <> 16) AND (dbo.mt_master_tarif.nama_tarif LIKE 'nebul%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_tarif_baru_v]");
    }
};
