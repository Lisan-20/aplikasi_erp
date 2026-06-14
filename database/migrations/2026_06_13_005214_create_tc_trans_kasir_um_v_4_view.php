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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_trans_kasir_um_v_4
AS
SELECT     bln, thn, SUM(tunai) AS tunai, SUM(debet) AS debet, SUM(kredit) AS kredit, SUM(nd) AS nd, SUM(nk) AS nk, SUM(nk_karyawan) AS nk_karyawan, 
                      SUM(nk_perusahaan) AS nk_perusahaan
FROM         dbo.tc_trans_kasir_um_v_3
GROUP BY bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_kasir_um_v_4]");
    }
};
