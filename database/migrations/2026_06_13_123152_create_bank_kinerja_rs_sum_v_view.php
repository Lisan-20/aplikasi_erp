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
        DB::statement("CREATE VIEW dbo.bank_kinerja_rs_sum_v
AS
SELECT     SUM(tx_nominal) AS tx_nominal, tipe, thn, bln
FROM         dbo.bank_kinerja_rs_v
GROUP BY tipe, thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bank_kinerja_rs_sum_v]");
    }
};
