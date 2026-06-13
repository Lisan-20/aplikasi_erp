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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_jatuh_tempo_penagihan_v
AS
SELECT     dbo.tx_harian.no_bukti, dbo.tc_tagih.no_invoice_tagih, dbo.tx_harian.acc_no, dbo.tx_harian.kel_jurnal, dbo.tx_harian.tgl_tempo, dbo.tc_tagih.tgl_jt_tempo
FROM         dbo.tx_harian INNER JOIN
                      dbo.tc_tagih ON dbo.tx_harian.no_bukti = dbo.tc_tagih.no_invoice_tagih
WHERE     (dbo.tx_harian.kel_jurnal = '5') AND (dbo.tx_harian.acc_no = 1130108)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_jatuh_tempo_penagihan_v]");
    }
};
