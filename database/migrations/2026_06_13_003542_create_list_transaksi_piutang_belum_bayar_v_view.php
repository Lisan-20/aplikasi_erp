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
        DB::statement("CREATE OR ALTER VIEW dbo.list_transaksi_piutang_belum_bayar_v
AS
SELECT     a.id_tc_tagih, a.no_invoice_tagih, a.jumlah_tagih, a.tgl_tagih, a.diskon, a.nama_tertagih, a.status_batal, a.jenis_tagih, SUM(b.pajak) AS pajak, 
                      SUM(b.tagihan_tidak_dicover) AS tagihan_tidak_dicover, SUM(b.biaya_transfer) AS biaya_transfer, dbo.transaksi_piutang.status_bayar, 
                      dbo.transaksi_piutang.tgl_bayar, SUM(dbo.transaksi_piutang.jumlah_transaksi) AS jumlah_transaksi
FROM         dbo.tc_tagih AS a LEFT OUTER JOIN
                      dbo.transaksi_piutang ON a.id_tc_tagih = dbo.transaksi_piutang.id_tc_tagih LEFT OUTER JOIN
                      dbo.tc_bayar_tagih AS b ON b.id_tc_tagih = a.id_tc_tagih
WHERE     (a.jenis_tagih = 3)
GROUP BY a.id_tc_tagih, a.no_invoice_tagih, a.jumlah_tagih, a.tgl_tagih, a.diskon, a.nama_tertagih, a.status_batal, a.jenis_tagih, 
                      dbo.transaksi_piutang.status_bayar, dbo.transaksi_piutang.tgl_bayar
HAVING      (a.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_transaksi_piutang_belum_bayar_v]");
    }
};
