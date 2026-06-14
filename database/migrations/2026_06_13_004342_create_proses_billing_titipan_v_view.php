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
        DB::statement("CREATE OR ALTER VIEW dbo.proses_billing_titipan_v
AS
SELECT     dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.bill_rs_asli, 
                      dbo.tc_trans_pelayanan.bill_dr1_asli, dbo.tc_trans_pelayanan.bill_dr2_asli, dbo.tc_trans_pelayanan.kode_klas, dbo.mt_master_tarif_detail.bill_rs_bpjs * dbo.tc_trans_pelayanan.jumlah AS tarif_rs, 
                      dbo.mt_master_tarif_detail.bill_dr1_bpjs * dbo.tc_trans_pelayanan.jumlah AS tarif_dr1, dbo.mt_master_tarif_detail.bill_dr2_bpjs * dbo.tc_trans_pelayanan.jumlah AS tarif_dr2, 
                      dbo.mt_master_tarif_detail.kode_klas AS kelas_tarif, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_master_tarif_detail.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_dr2_bpjs, dbo.tc_trans_pelayanan.jatah_klas
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif AND dbo.tc_trans_pelayanan.jatah_klas = dbo.mt_master_tarif_detail.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.kode_klas <> 16) AND (dbo.tc_trans_pelayanan.jenis_tindakan <> 11) AND 
                      (dbo.tc_trans_pelayanan.kode_bagian NOT IN ('030901', '030501'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_billing_titipan_v]");
    }
};
