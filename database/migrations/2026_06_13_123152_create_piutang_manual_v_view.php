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
        DB::statement("CREATE OR ALTER VIEW dbo.piutang_manual_v
AS
SELECT     SUM(jumlah_transaksi) AS jumlah, id_tc_tagih
FROM         dbo.transaksi_piutang
GROUP BY id_tc_tagih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [piutang_manual_v]");
    }
};
