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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_dr_RJ_v
AS
SELECT     dbo.billing_rj_v.no_registrasi, dbo.billing_rj_v.no_mr, dbo.billing_rj_v.kode_kelompok, dbo.billing_rj_v.kode_perusahaan, dbo.billing_rj_v.jenis_tindakan, 
                      dbo.billing_rj_v.bill_dr1, dbo.billing_rj_v.kode_dokter1, dbo.billing_rj_v.kode_bagian, dbo.billing_rj_v.kode_bagian_asal, dbo.kasir_rj_v.seri_kuitansi, 
                      dbo.kasir_rj_v.no_kuitansi, dbo.kasir_rj_v.tgl_jam, dbo.mapping_transaksi_rs_v.kode_proses, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.mapping_transaksi_rs_v.nama_bagian, dbo.mapping_transaksi_rs_v.nama_kredit, dbo.billing_rj_v.kode_tc_trans_kasir, dbo.billing_rj_v.bill_rs
FROM         dbo.kasir_rj_v INNER JOIN
                      dbo.billing_rj_v ON dbo.kasir_rj_v.kode_tc_trans_kasir = dbo.billing_rj_v.kode_tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.billing_rj_v.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.billing_rj_v.bill_dr1 > 0) AND (dbo.mapping_transaksi_rs_v.kode_jenis_proses = 11) AND 
                      (dbo.kasir_rj_v.seri_kuitansi = 'RJ') AND (dbo.kasir_rj_v.flag_jurnal = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_dr_RJ_v]");
    }
};
