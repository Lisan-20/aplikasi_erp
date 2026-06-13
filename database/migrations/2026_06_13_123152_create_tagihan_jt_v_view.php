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
        DB::statement("CREATE VIEW dbo.tagihan_jt_v
AS
SELECT     TOP (100) PERCENT a.id_tc_tagih, a.no_invoice_tagih, a.jumlah_tagih, a.tgl_tagih, a.diskon, a.nama_tertagih, a.status_batal, a.jenis_tagih, SUM(b.jumlah_bayar) AS total_bayar, SUM(b.pajak) 
                      AS pajak, SUM(a.diskon) AS diskon_bayar, SUM(b.tagihan_tidak_dicover) AS tagihan_tidak_dicover, SUM(b.biaya_transfer) AS biaya_transfer, SUM(b.diskon) AS Expr1, a.tgl_jt_tempo, DATEDIFF(dd, 
                      GETDATE(), a.tgl_jt_tempo) AS jatuh_tempo
FROM         dbo.piutang_list_bayar_v AS a LEFT OUTER JOIN
                      dbo.tc_bayar_tagih_v AS b ON b.id_tc_tagih = a.id_tc_tagih
GROUP BY a.id_tc_tagih, a.no_invoice_tagih, a.jumlah_tagih, a.tgl_tagih, a.diskon, a.nama_tertagih, a.status_batal, a.jenis_tagih, a.tgl_jt_tempo, DATEDIFF(dd, GETDATE(), a.tgl_jt_tempo)
HAVING      (a.jumlah_tagih > SUM(b.jumlah_bayar) + a.diskon + SUM(b.diskon) + SUM(b.pajak) + SUM(b.tagihan_tidak_dicover) + SUM(b.biaya_transfer) OR
                      SUM(b.jumlah_bayar) IS NULL) AND (a.status_batal IS NULL)
ORDER BY a.id_tc_tagih DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_jt_v]");
    }
};
