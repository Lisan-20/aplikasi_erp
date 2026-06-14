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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_pembayaran_piutang_d
AS
SELECT     SUM(dbo.bd_tc_trans_detail.jumlah) AS debet, dbo.bd_tc_trans_detail.id_bd_tc_trans, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans_detail.tgl_ver, 
                      dbo.bd_tc_trans_detail.flag_jurnal, dbo.bd_tc_trans.flag_tmp, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans_detail.diskon
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.bd_tc_trans ON dbo.bd_tc_trans_detail.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
GROUP BY dbo.bd_tc_trans_detail.id_bd_tc_trans, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans_detail.tgl_ver, dbo.bd_tc_trans_detail.flag_jurnal, dbo.bd_tc_trans.flag_tmp, 
                      dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans_detail.diskon
HAVING      (dbo.bd_tc_trans_detail.tx_tipe = 1) AND (dbo.bd_tc_trans_detail.tgl_ver IS NULL) AND (dbo.bd_tc_trans_detail.flag_jurnal = 0) AND (dbo.bd_tc_trans.flag_tmp IS NULL)
                       AND (dbo.bd_tc_trans.no_bukti LIKE '%KU%') AND (dbo.bd_tc_trans_detail.diskon <= 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pembayaran_piutang_d]");
    }
};
