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
        DB::statement("CREATE VIEW dbo.tarif_update_bpjs
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, 
                      dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr2_bpjs, 
                      dbo.mt_master_tarif_detail.kode_klas, dbo.mt_klas.nama_klas, dbo.upd_bpjs_rad2.tarif AS Expr1, dbo.upd_bpjs_rad2.klas3, 
                      dbo.mt_master_tarif_detail.total_bpjs
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.upd_bpjs_rad2 ON dbo.mt_master_tarif.nama_tarif = dbo.upd_bpjs_rad2.tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_update_bpjs]");
    }
};
