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
        DB::statement("CREATE OR ALTER VIEW dbo.bd_tc_trans_balance
AS
SELECT     dbo.bd_tc_trans_debet.id_bd_tc_trans, dbo.bd_tc_trans_debet.debet, dbo.bd_tc_trans_kredit.kredit
FROM         dbo.bd_tc_trans_debet INNER JOIN
                      dbo.bd_tc_trans_kredit ON dbo.bd_tc_trans_debet.id_bd_tc_trans = dbo.bd_tc_trans_kredit.id_bd_tc_trans AND 
                      dbo.bd_tc_trans_debet.debet = dbo.bd_tc_trans_kredit.kredit
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_balance]");
    }
};
