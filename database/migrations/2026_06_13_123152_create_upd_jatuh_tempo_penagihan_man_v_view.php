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
        DB::statement("CREATE VIEW dbo.upd_jatuh_tempo_penagihan_man_v
AS
SELECT     dbo.tx_harian.no_bukti, dbo.tx_harian.acc_no, dbo.tx_harian.kel_jurnal, dbo.tx_harian.tgl_tempo, dbo.transaksi_piutang.tgl_tempo AS tgl_jt_tempo
FROM         dbo.tx_harian INNER JOIN
                      dbo.transaksi_piutang ON dbo.tx_harian.no_bukti = dbo.transaksi_piutang.no_bukti
WHERE     (dbo.tx_harian.acc_no = 1130108) AND (dbo.tx_harian.kel_jurnal = '10')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_jatuh_tempo_penagihan_man_v]");
    }
};
