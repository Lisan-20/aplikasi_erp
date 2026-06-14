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
        DB::statement("CREATE OR ALTER VIEW dbo.jml_kobag_tran_v
AS
SELECT     COUNT(DISTINCT kode_bagian) AS jumlah, kode_tc_trans_kasir
FROM         dbo.tran_sed
GROUP BY seri_kuitansi, flag_jurnal, kode_tc_trans_kasir
HAVING      (seri_kuitansi IN ('RJ', 'AJ')) AND (flag_jurnal IS NULL) AND (COUNT(DISTINCT kode_bagian) = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_kobag_tran_v]");
    }
};
