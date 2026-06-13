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
        DB::statement("CREATE VIEW dbo.laba_rugi_ak_3_v
AS
SELECT     TOP (100) PERCENT dbo.mt_account.acc_no, dbo.mt_account.referensi, dbo.neraca_ak_4_v.bulan, dbo.neraca_ak_4_v.tahun, SUM(dbo.neraca_ak_4_v.mutasi_d) 
                      AS mutasi_d, SUM(dbo.neraca_ak_4_v.mutasi_k) AS mutasi_k, SUM(dbo.neraca_ak_4_v.saldo_awal) AS bulan_lalu, SUM(dbo.neraca_ak_4_v.saldo_akhir) 
                      AS sd_bulan_ini, dbo.neraca_ak_4_v.flag, SUM(dbo.neraca_ak_4_v.mutasi_d - dbo.neraca_ak_4_v.mutasi_k) AS bulan_ini, 
                      SUM(dbo.neraca_ak_4_v.mutasi_k - dbo.neraca_ak_4_v.mutasi_d) AS pen_bulan_ini, dbo.neraca_ak_4_v.acc_type
FROM         dbo.mt_account INNER JOIN
                      dbo.neraca_ak_4_v ON dbo.mt_account.acc_no = dbo.neraca_ak_4_v.referensi
GROUP BY dbo.mt_account.acc_no, dbo.mt_account.level_coa, dbo.mt_account.referensi, dbo.neraca_ak_4_v.bulan, dbo.neraca_ak_4_v.tahun, dbo.neraca_ak_4_v.flag, 
                      dbo.neraca_ak_4_v.acc_type
HAVING      (dbo.mt_account.level_coa = 3)
ORDER BY dbo.neraca_ak_4_v.bulan, dbo.neraca_ak_4_v.acc_type, dbo.neraca_ak_4_v.tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laba_rugi_ak_3_v]");
    }
};
