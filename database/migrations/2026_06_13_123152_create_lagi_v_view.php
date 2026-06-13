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
        DB::statement("CREATE OR ALTER VIEW dbo.lagi_v
AS
SELECT     dbo.tx_harian.kode_tc_trans_kasir, dbo.tx_harian.kel_jurnal, dbo.tx_harian.no_bukti, dbo.tx_harian.no_registrasi, tx_harian_1.kode_tc_trans_kasir AS kode_tc_trans_kasir_upd, tx_harian_1.tx_tipe, 
                      tx_harian_1.no_bukti AS Expr2
FROM         dbo.tx_harian INNER JOIN
                      dbo.tx_harian AS tx_harian_1 ON dbo.tx_harian.no_registrasi = tx_harian_1.no_registrasi
WHERE     (dbo.tx_harian.kel_jurnal = '2') AND (dbo.tx_harian.no_bukti LIKE 'UM%') AND (tx_harian_1.tx_tipe = 'D') AND (NOT (tx_harian_1.no_bukti LIKE '%UM%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lagi_v]");
    }
};
