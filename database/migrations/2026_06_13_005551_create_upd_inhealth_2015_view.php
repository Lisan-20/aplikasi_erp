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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_inhealth_2015
AS
SELECT     dbo.mt_master_tarif_detail.kode_tarif, dbo.upd_inhealth_lab.tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.mt_klas.nama_klas, dbo.mt_master_tarif_detail.bill_dr1_inhealth, dbo.mt_master_tarif_detail.bill_dr2_inhealth, 
                      dbo.mt_master_tarif_detail.bill_rs_inhealth, dbo.mt_master_tarif_detail.total_inhealth, dbo.mt_master_tarif.tingkatan, 
                      CAST(0.01 / 1 * dbo.upd_inhealth_lab.klas3 AS int) AS upd_dr, dbo.upd_inhealth_lab.klas3 - CAST(0.01 / 1 * dbo.upd_inhealth_lab.klas3 AS int) 
                      AS upd_rs, dbo.upd_inhealth_lab.klas3
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.upd_inhealth_lab ON dbo.mt_master_tarif.nama_tarif = dbo.upd_inhealth_lab.tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif_detail.kode_klas = 16)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_inhealth_2015]");
    }
};
