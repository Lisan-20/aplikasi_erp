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
        DB::statement("CREATE VIEW dbo.upd_inhealth_lab_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, upd_inhealth_lab_1.tarif, dbo.mt_master_tarif.tingkatan, 
                      dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs_inhealth, dbo.mt_master_tarif_detail.bill_dr1_inhealth, 
                      dbo.mt_master_tarif_detail.total_inhealth, dbo.mt_klas.nama_klas, upd_inhealth_lab_1.klas1, CAST(0.01 / 1 * upd_inhealth_lab_1.klas1 AS int) 
                      AS bill_dr1_upd, upd_inhealth_lab_1.klas1 - CAST(0.01 / 1 * upd_inhealth_lab_1.klas1 AS int) AS bill_rs_upd
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.upd_inhealth_lab AS upd_inhealth_lab_1 ON dbo.mt_master_tarif.nama_tarif = upd_inhealth_lab_1.tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif_detail.kode_klas = 8)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_inhealth_lab_v]");
    }
};
