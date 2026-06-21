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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_rl_310_v
AS
SELECT     kode_tarif, MONTH(tgl_transaksi) AS bln, YEAR(tgl_transaksi) AS thn, COUNT(no_registrasi) AS jml, status_batal, tgl_transaksi
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_tarif, MONTH(tgl_transaksi), YEAR(tgl_transaksi), status_batal, tgl_transaksi
HAVING      (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_rl_310_v]");
    }
};
