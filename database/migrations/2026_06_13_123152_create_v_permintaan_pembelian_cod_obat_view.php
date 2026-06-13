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
        DB::statement("CREATE VIEW dbo.v_permintaan_pembelian_cod_obat
AS
SELECT     TOP (20) a.id_tc_permohonan, a.no_acc, a.kode_permohonan, a.tgl_permohonan, a.status_batal, a.kodesupplier, COUNT(b.id_tc_permohonan_det) AS jml_brg, dbo.transaksi_umd.status_bayar, 
                      dbo.transaksi_umd.kode_bagian, a.flag_is
FROM         dbo.tc_permohonan_cash AS a INNER JOIN
                      dbo.tc_permohonan_cash_det AS b ON b.id_tc_permohonan = a.id_tc_permohonan INNER JOIN
                      dbo.mt_barang ON b.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.transaksi_umd ON a.id_trans_umd = dbo.transaksi_umd.id_trans_umd
WHERE     (a.status_batal = 0) AND (a.status_kirim = 1)
GROUP BY a.no_acc, a.id_tc_permohonan, a.kode_permohonan, a.tgl_permohonan, a.status_batal, a.kodesupplier, dbo.transaksi_umd.status_bayar, dbo.transaksi_umd.kode_bagian, a.flag_is
ORDER BY a.tgl_permohonan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_permintaan_pembelian_cod_obat]");
    }
};
