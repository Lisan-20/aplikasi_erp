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
        DB::statement("CREATE VIEW dbo.jml_biaya_transfer_piut_man_v
AS
SELECT     id_bd_tc_trans, SUM(jumlah) AS biaya_transfer, acc_no
FROM         dbo.bd_tc_trans_detail
GROUP BY id_bd_tc_trans, acc_no
HAVING      (acc_no = '4210702')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_biaya_transfer_piut_man_v]");
    }
};
