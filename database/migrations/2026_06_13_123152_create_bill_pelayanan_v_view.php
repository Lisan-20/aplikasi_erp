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
        DB::statement("CREATE VIEW dbo.bill_pelayanan_v
AS
SELECT     kode_tc_trans_kasir, no_registrasi, no_mr, kode_kelompok, kode_perusahaan, SUM(bill_rs) + SUM(bill_dr1) + SUM(bill_dr2) AS billing
FROM         dbo.tc_trans_pelayanan
WHERE     (YEAR(tgl_transaksi) >= 2012) AND (kode_tc_trans_kasir > 0)
GROUP BY kode_tc_trans_kasir, no_registrasi, no_mr, kode_kelompok, kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_pelayanan_v]");
    }
};
