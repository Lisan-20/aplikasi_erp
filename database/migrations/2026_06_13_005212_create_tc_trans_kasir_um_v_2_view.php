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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_trans_kasir_um_v_2
AS
SELECT     DAY(tgl_jam) AS tgl, MONTH(tgl_jam) AS bln, YEAR(tgl_jam) AS thn, SUM(tunai) AS tunai, SUM(debet) AS debet, SUM(kredit) AS kredit, SUM(nd) AS nd, 
                      SUM(nk) AS nk, SUM(nk_karyawan) AS nk_karyawan, SUM(nk_perusahaan) AS nk_perusahaan, seri_kuitansi
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL)
GROUP BY DAY(tgl_jam), MONTH(tgl_jam), YEAR(tgl_jam), seri_kuitansi
HAVING      (seri_kuitansi = 'UM')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_kasir_um_v_2]");
    }
};
