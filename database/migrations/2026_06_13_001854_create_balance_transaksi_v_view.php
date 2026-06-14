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
        DB::statement("CREATE OR ALTER VIEW dbo.balance_transaksi_v
AS
SELECT     a.no_bukti, a.id_transaksi, a.inp_id, a.jumlah_transaksi, b.total_debet, c.total_kredit, a.flag_tmp, dbo.transaksi_detail.id_transaksi_detail
FROM         dbo.transaksi AS a INNER JOIN
                      dbo.transaksi_detail ON a.id_transaksi = dbo.transaksi_detail.id_transaksi LEFT OUTER JOIN
                          (SELECT     id_transaksi, SUM(jumlah) AS total_debet
                            FROM          dbo.transaksi_detail AS transaksi_detail_2
                            WHERE      (tipe_tx = 0)
                            GROUP BY id_transaksi) AS b ON a.id_transaksi = b.id_transaksi LEFT OUTER JOIN
                          (SELECT     id_transaksi, SUM(jumlah) AS total_kredit
                            FROM          dbo.transaksi_detail AS transaksi_detail_1
                            WHERE      (tipe_tx = 1)
                            GROUP BY id_transaksi) AS c ON a.id_transaksi = c.id_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [balance_transaksi_v]");
    }
};
