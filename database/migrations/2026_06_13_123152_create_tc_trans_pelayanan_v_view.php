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
        DB::statement("CREATE VIEW dbo.tc_trans_pelayanan_v
AS
SELECT     no_mr, kode_tarif, YEAR(tgl_transaksi) AS thn, MONTH(tgl_transaksi) AS bln, DAY(tgl_transaksi) AS day, kode_bagian, tgl_transaksi
FROM         dbo.tc_trans_pelayanan
GROUP BY no_mr, kode_tarif, YEAR(tgl_transaksi), MONTH(tgl_transaksi), DAY(tgl_transaksi), kode_bagian, tgl_transaksi
HAVING      (kode_bagian = '030901') AND (kode_tarif IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_v]");
    }
};
