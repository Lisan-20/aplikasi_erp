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
        DB::statement("CREATE OR ALTER VIEW dbo.v_pindah_billing_umum_persh_rajal
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, dbo.mt_klas.nama_klas, dbo.tc_trans_pelayanan.bill_rs AS bill_rs_trans, 
                      dbo.tc_trans_pelayanan.bill_dr1 AS bill_dr1_trans, dbo.tc_trans_pelayanan.bill_dr2 AS bill_dr2_trans, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_pelayanan.kode_bagian AS kode_bagian_trans, dbo.mt_tarif_v.bill_rs, dbo.mt_tarif_v.bill_dr1, dbo.mt_tarif_v.total, dbo.mt_tarif_v.bill_dr2, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah
FROM         dbo.mt_tarif_v INNER JOIN
                      dbo.mt_bagian ON dbo.mt_tarif_v.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_klas.kode_klas = dbo.tc_trans_pelayanan.kode_klas ON dbo.mt_tarif_v.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_tarif_v.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.kode_bagian <> '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_pindah_billing_umum_persh_rajal]");
    }
};
