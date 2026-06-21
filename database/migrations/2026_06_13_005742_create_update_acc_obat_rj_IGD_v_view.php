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
        DB::statement("CREATE OR ALTER VIEW dbo.update_acc_obat_rj_IGD_v
AS
SELECT     kel_jurnal, acc_no, kode_bagian
FROM         dbo.tx_harian
WHERE     (kel_jurnal = '2') AND (acc_no = 3150101) AND (kode_bagian LIKE '02%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_acc_obat_rj_IGD_v]");
    }
};
