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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_dobel_D_jurnal_ri
AS
SELECT     kode_inap, kel_jurnal, COUNT(kode_inap) AS Expr1, acc_no, MAX(no_urut) AS no_urut
FROM         dbo.tx_harian
WHERE     (tx_tipe = 'D')
GROUP BY kode_inap, kel_jurnal, acc_no
HAVING      (kel_jurnal = '2') AND (COUNT(kode_inap) = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_dobel_D_jurnal_ri]");
    }
};
