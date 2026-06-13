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
        DB::statement("CREATE VIEW dbo.jurnal_ri_v
AS
SELECT DISTINCT no_registrasi, YEAR(tx_tgl) AS tahun, kode_tc_trans_kasir, no_bukti, kode_inap
FROM         dbo.tx_harian
WHERE     (kel_jurnal = 2) AND (YEAR(tx_tgl) >= 2016) AND (NOT (no_bukti LIKE 'UM%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_ri_v]");
    }
};
