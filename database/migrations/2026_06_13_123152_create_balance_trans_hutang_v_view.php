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
        DB::statement("CREATE VIEW dbo.balance_trans_hutang_v
AS
SELECT     a.no_bukti, a.id_trans_hutang, a.inp_id, a.jumlah_transaksi, b.total_debet, c.total_kredit, a.flag_tmp, dbo.transaksi_hutang_detail.id_trans_hutang_detail
FROM         dbo.transaksi_hutang AS a INNER JOIN
                      dbo.transaksi_hutang_detail ON a.id_trans_hutang = dbo.transaksi_hutang_detail.id_trans_hutang LEFT OUTER JOIN
                          (SELECT     id_trans_hutang, SUM(jumlah) AS total_debet
                            FROM          dbo.transaksi_hutang_detail AS transaksi_hutang_detail_2
                            WHERE      (tipe_tx = 0)
                            GROUP BY id_trans_hutang) AS b ON a.id_trans_hutang = b.id_trans_hutang LEFT OUTER JOIN
                          (SELECT     id_trans_hutang, SUM(jumlah) AS total_kredit
                            FROM          dbo.transaksi_hutang_detail AS transaksi_hutang_detail_1
                            WHERE      (tipe_tx = 1)
                            GROUP BY id_trans_hutang) AS c ON a.id_trans_hutang = c.id_trans_hutang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [balance_trans_hutang_v]");
    }
};
