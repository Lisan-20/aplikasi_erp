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
        DB::statement("CREATE OR ALTER VIEW dbo.update_no_kuitansi2_v
AS
SELECT     ROW_NUMBER() OVER (PARTITION BY tgl, bln, thn
ORDER BY tgl DESC) AS no, seri_kuitansi, no_kuitansi, RIGHT('0' + CAST(tgl AS varchar(2)), 2) AS tgl, bln, thn, CAST(CAST(RIGHT(thn, 2) AS varchar(2)) + '' + RIGHT('0' + CAST(bln AS varchar(2)), 2) 
+ '' + RIGHT('0' + CAST(tgl AS varchar(2)), 2) AS varchar(50)) AS Expr1, CAST(seri_kuitansi + '-' + CAST(no_kuitansi AS varchar(50)) AS varchar(100)) AS Expr2,
    (SELECT     TOP (1) no_kuitansi AS no_kuit
      FROM          dbo.tc_trans_kasir
      GROUP BY seri_kuitansi, no_kuitansi, DAY(tgl_jam), MONTH(tgl_jam), LEN(no_kuitansi)
      HAVING      (seri_kuitansi = 'RI') AND (DAY(tgl_jam) = 29) AND (MONTH(tgl_jam) = 3) AND (LEN(no_kuitansi) = 10) AND (no_kuitansi LIKE '170329%')
      ORDER BY no_kuit DESC) AS nokui
FROM         dbo.update_no_kuitansi_v
WHERE     (seri_kuitansi = 'RI') and bln = 3 and tgl = 29
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_no_kuitansi2_v]");
    }
};
