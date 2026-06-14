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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bill_dr_trans_pelayanan_ass_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.mt_master_tarif_detail_perusahaan.bill_rs AS tarif_rs, dbo.mt_master_tarif_detail_perusahaan.bill_dr1 AS tarif_dr, dbo.mt_master_tarif_detail_perusahaan.total, 
                      dbo.mt_master_tarif_detail_perusahaan.bhp, dbo.tc_trans_pelayanan.kode_klas, dbo.mt_master_tarif_detail_perusahaan.kode_klas AS Expr1, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail_perusahaan ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_perusahaan.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.status_selesai >= 2) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) IN (5, 6)) AND (dbo.tc_trans_pelayanan.kode_tarif LIKE '1%') AND 
                      (dbo.tc_trans_pelayanan.kode_bagian NOT IN ('030501', '030901')) AND (dbo.mt_master_tarif_detail_perusahaan.bhp = 0) AND 
                      (dbo.tc_trans_pelayanan.bill_dr1_jatah > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bill_dr_trans_pelayanan_ass_v]");
    }
};
