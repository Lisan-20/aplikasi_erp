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
        DB::statement("CREATE OR ALTER VIEW dbo.View_2
AS
SELECT     acc_no, kel_jurnal, tx_nominal, COUNT(no_bukti) AS Expr1, tx_tipe, no_bukti
FROM         dbo.tx_harian
GROUP BY acc_no, kel_jurnal, tx_nominal, tx_tipe, no_bukti
HAVING      (acc_no = 1130101) AND (kel_jurnal = '2') AND (COUNT(no_bukti) > 1) AND (tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [View_2]");
    }
};
