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
        DB::statement("CREATE VIEW dbo.jurnal_kredit_v
AS
SELECT     SUM(tx_nominal) AS kredit, tx_tipe, no_bukti, kode_tc_trans_kasir
FROM         dbo.tx_harian
WHERE     (tx_tipe = 'K')
GROUP BY tx_tipe, no_bukti, kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_kredit_v]");
    }
};
