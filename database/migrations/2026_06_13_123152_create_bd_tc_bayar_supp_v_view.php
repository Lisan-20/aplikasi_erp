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
        DB::statement("CREATE VIEW dbo.bd_tc_bayar_supp_v
AS
SELECT     id_bd_tc_trans, SUM(jumlah) AS jml_bayar
FROM         dbo.bd_tc_trans
GROUP BY id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_bayar_supp_v]");
    }
};
