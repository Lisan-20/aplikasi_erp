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
        DB::statement("CREATE OR ALTER VIEW dbo.luar_modul_bayar_v
AS
SELECT     id_tc_tagih, SUM(jumlah_transaksi) AS jumlah_transaksi, kode_perusahaan
FROM         dbo.transaksi_piutang
GROUP BY id_tc_tagih, kode_perusahaan
HAVING      (id_tc_tagih > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [luar_modul_bayar_v]");
    }
};
