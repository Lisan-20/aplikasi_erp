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
        DB::statement("CREATE VIEW dbo.update_bukti_jurnal_kb_v
AS
SELECT     dbo.tx_harian.no_bukti, dbo.tx_harian.no_jurnal, dbo.bd_tc_trans.no_bukti AS bukti, dbo.bd_tc_trans.jumlah
FROM         dbo.tx_harian INNER JOIN
                      dbo.bd_tc_trans ON dbo.tx_harian.no_jurnal = dbo.bd_tc_trans.id_bd_tc_trans AND dbo.tx_harian.tx_nominal = dbo.bd_tc_trans.jumlah AND 
                      dbo.tx_harian.no_bukti <> dbo.bd_tc_trans.no_bukti
WHERE     (dbo.tx_harian.kel_jurnal = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bukti_jurnal_kb_v]");
    }
};
