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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_tc_far_v
AS
SELECT     TOP (100) PERCENT MIN(DISTINCT kode_trans_far) AS kode_trans_far, MIN(DISTINCT tgl_trans) AS tgl_trans, no_mr, no_registrasi, no_kunjungan, status_transaksi, kode_resep, DAY(tgl_trans) 
                      AS hari, MONTH(tgl_trans) AS bln, YEAR(tgl_trans) AS thn
FROM         dbo.fr_tc_far
GROUP BY no_mr, no_registrasi, no_kunjungan, status_transaksi, kode_resep, DAY(tgl_trans), MONTH(tgl_trans), YEAR(tgl_trans)
HAVING      (kode_resep IS NOT NULL) AND (status_transaksi = 1)
ORDER BY tgl_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_far_v]");
    }
};
