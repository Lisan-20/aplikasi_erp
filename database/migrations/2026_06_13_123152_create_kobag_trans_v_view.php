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
        DB::statement("CREATE VIEW dbo.kobag_trans_v
AS
SELECT     COUNT(DISTINCT kode_bagian) AS jum_kobag, no_registrasi
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, MONTH(tgl_transaksi), kode_tc_trans_kasir
HAVING      (COUNT(DISTINCT kode_bagian) = 1) AND (no_registrasi > 0) AND (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kobag_trans_v]");
    }
};
