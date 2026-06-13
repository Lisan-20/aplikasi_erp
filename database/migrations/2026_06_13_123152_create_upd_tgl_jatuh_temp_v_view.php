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
        DB::statement("CREATE VIEW dbo.upd_tgl_jatuh_temp_v
AS
SELECT     dbo.transaksi_hutang.no_bukti, dbo.tx_harian.tgl_tempo, dbo.transaksi_hutang.tgl_tempo AS tgl
FROM         dbo.tx_harian INNER JOIN
                      dbo.transaksi_hutang ON dbo.tx_harian.no_bukti = dbo.transaksi_hutang.no_bukti
WHERE     (dbo.tx_harian.kel_jurnal = 11)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tgl_jatuh_temp_v]");
    }
};
