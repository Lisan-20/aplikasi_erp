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
        DB::statement("CREATE VIEW dbo.upd_kd_inv_persh_tx
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir_24102013.kd_inv_persh_tx AS kd_inv_persh_tx_lama
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_kasir_24102013 ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_kasir_24102013.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir_24102013.kd_inv_persh_tx > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kd_inv_persh_tx]");
    }
};
