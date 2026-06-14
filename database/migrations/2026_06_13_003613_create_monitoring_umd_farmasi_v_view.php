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
        DB::statement("CREATE OR ALTER VIEW dbo.monitoring_umd_farmasi_v
AS
SELECT     dbo.tc_permohonan_cash.id_tc_permohonan, dbo.tc_permohonan_cash.kode_permohonan, COUNT(dbo.tc_permohonan_cash_det.id_tc_permohonan_det) AS jml_brg, 
                      dbo.transaksi_umd.tgl_transaksi AS tgl_umd, dbo.tc_permohonan_cash.kodesupplier, dbo.mt_supplier.namasupplier, dbo.transaksi_umd.no_bukti AS no_umd, 
                      mt_supplier_1.namasupplier AS namasupplier_umd, COUNT(dbo.transaksi_umd_detail.id_tc_trans_umd_det) AS jml_brg_umd, dbo.tc_permohonan_cash.tgl_permohonan, 
                      dbo.transaksi_umd.id_trans_umd, dbo.transaksi_umd.stat_ver, dbo.transaksi_umd_detail.jumlah_besar_acc, dbo.transaksi_umd.kode_supplier, dbo.tc_permohonan_cash.status_batal, 
                      dbo.transaksi_umd.tgl_bayar
FROM         dbo.mt_supplier AS mt_supplier_1 LEFT OUTER JOIN
                      dbo.transaksi_umd_detail INNER JOIN
                      dbo.transaksi_umd ON dbo.transaksi_umd_detail.id_trans_umd = dbo.transaksi_umd.id_trans_umd ON mt_supplier_1.kodesupplier = dbo.transaksi_umd.kode_supplier RIGHT OUTER JOIN
                      dbo.tc_permohonan_cash_det INNER JOIN
                      dbo.tc_permohonan_cash ON dbo.tc_permohonan_cash_det.id_tc_permohonan = dbo.tc_permohonan_cash.id_tc_permohonan LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.tc_permohonan_cash.kodesupplier = dbo.mt_supplier.kodesupplier ON dbo.transaksi_umd.id_trans_umd = dbo.tc_permohonan_cash.id_trans_umd
GROUP BY dbo.tc_permohonan_cash.id_tc_permohonan, dbo.tc_permohonan_cash.kode_permohonan, dbo.transaksi_umd.tgl_transaksi, dbo.tc_permohonan_cash.kodesupplier, 
                      dbo.mt_supplier.namasupplier, dbo.transaksi_umd.no_bukti, mt_supplier_1.namasupplier, dbo.tc_permohonan_cash.tgl_permohonan, dbo.transaksi_umd.id_trans_umd, 
                      dbo.transaksi_umd.stat_ver, dbo.transaksi_umd_detail.jumlah_besar_acc, dbo.transaksi_umd.kode_supplier, dbo.tc_permohonan_cash.status_batal, dbo.transaksi_umd.tgl_bayar
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [monitoring_umd_farmasi_v]");
    }
};
