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
        DB::statement("CREATE OR ALTER VIEW dbo.v_pindah_billing_assuransi_okvk
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_tarif_detail_perusahaan.kode_klas, dbo.mt_klas.nama_klas, dbo.tc_trans_pelayanan.bill_rs_jatah AS bill_rs_trans, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah AS bill_dr1_trans, dbo.tc_trans_pelayanan.bill_dr2_jatah AS bill_dr2_trans, dbo.mt_master_tarif_detail_perusahaan.total, 
                      dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_bagian AS kode_bagian_trans, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_perusahaan ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_perusahaan.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_perusahaan.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND dbo.mt_klas.kode_klas = dbo.tc_trans_pelayanan.kode_klas AND
                       dbo.mt_master_tarif_detail_perusahaan.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.kode_tarif IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah))
ORDER BY dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail_perusahaan.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_pindah_billing_assuransi_okvk]");
    }
};
