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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_lab_ri
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, 
                      dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_master_tarif_detail.bill_dr3, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, dbo.mt_master_tarif_detail.bill_dr2_pt, 
                      dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_dr2_ass, dbo.mt_master_tarif_detail.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_dr2_bpjs, dbo.mt_master_tarif_detail.bill_rs_inhealth, dbo.mt_master_tarif_detail.bill_dr1_inhealth, 
                      dbo.mt_master_tarif_detail.bill_dr2_inhealth, dbo.mt_master_tarif_detail.total_inhealth, dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.total_pt, dbo.mt_master_tarif_detail.total_ass, 
                      dbo.mt_master_tarif_detail.total_bpjs, dbo.mt_master_tarif_detail.bhp, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif_detail.bill_rs_nayaka, dbo.mt_master_tarif_detail.bill_dr1_nayaka, 
                      dbo.mt_master_tarif_detail.bill_rs_hardlent, dbo.mt_master_tarif_detail.bill_dr1_hardlent, dbo.mt_master_tarif_detail.bill_rs_cahaya, dbo.mt_master_tarif_detail.bill_dr1_cahaya
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif.kode_bagian = '050101') AND (dbo.mt_master_tarif_detail.kode_klas = 6)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_lab_ri]");
    }
};
