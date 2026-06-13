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
        DB::statement("CREATE VIEW dbo.upd_billing_pasien_v
AS
SELECT     dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.mt_master_tarif_detail.bill_rs AS RSIII, dbo.tc_trans_pelayanan.bill_dr1, dbo.mt_master_tarif_detail.bill_dr1 AS DR1III, 
                      dbo.tc_trans_pelayanan.bill_dr2, dbo.mt_master_tarif_detail.bill_dr2 AS DR2III, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.no_kamar, 
                      dbo.tc_trans_pelayanan.no_bed, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_master_tarif_detail.kode_klas AS Expr4
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 31444) AND (dbo.mt_master_tarif_detail.kode_klas = 7)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_billing_pasien_v]");
    }
};
