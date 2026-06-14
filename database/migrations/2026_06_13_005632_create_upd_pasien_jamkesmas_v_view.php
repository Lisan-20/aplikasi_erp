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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_pasien_jamkesmas_v
AS
SELECT     dbo.mt_master_tarif_detail_jamkesmas.bill_rs, dbo.mt_master_tarif_detail_jamkesmas.bill_dr1, dbo.mt_master_tarif_detail_jamkesmas.bill_dr2, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.tc_trans_pelayanan.bill_rs AS Expr1, dbo.tc_trans_pelayanan.bill_dr1 AS Expr2
FROM         dbo.mt_master_tarif_detail_jamkesmas INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif_detail_jamkesmas.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_jamkesmas.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 124735)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_pasien_jamkesmas_v]");
    }
};
