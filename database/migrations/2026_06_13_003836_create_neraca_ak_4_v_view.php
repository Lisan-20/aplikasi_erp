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
        DB::statement("CREATE OR ALTER VIEW dbo.neraca_ak_4_v
AS
SELECT     dbo.mt_account.acc_no, dbo.mt_account.referensi, SUM(dbo.neraca_ak_5_v.mutasi_d) AS mutasi_d, SUM(dbo.neraca_ak_5_v.mutasi_k) AS mutasi_k, 
                      SUM(dbo.neraca_ak_5_v.saldo_awal) AS saldo_awal, SUM(dbo.neraca_ak_5_v.saldo_akhir) AS saldo_akhir, dbo.neraca_ak_5_v.bulan, dbo.neraca_ak_5_v.tahun, 
                      dbo.neraca_ak_5_v.acc_type, dbo.neraca_ak_5_v.flag, dbo.neraca_ak_5_v.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.neraca_ak_5_v ON dbo.mt_account.acc_no = dbo.neraca_ak_5_v.referensi
WHERE     (dbo.mt_account.level_coa = 4)
GROUP BY dbo.mt_account.acc_no, dbo.mt_account.referensi, dbo.neraca_ak_5_v.bulan, dbo.neraca_ak_5_v.tahun, dbo.neraca_ak_5_v.acc_type, dbo.neraca_ak_5_v.flag, 
                      dbo.neraca_ak_5_v.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [neraca_ak_4_v]");
    }
};
