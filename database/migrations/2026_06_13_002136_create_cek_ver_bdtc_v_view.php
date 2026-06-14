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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_ver_bdtc_v
AS
SELECT     TOP (100) PERCENT dbo.cek_ver_bdtc_k_v.K, dbo.cek_ver_bdtc_d_v.d, dbo.cek_ver_bdtc_d_v.no_bukti, 
                      dbo.cek_ver_bdtc_k_v.K - dbo.cek_ver_bdtc_d_v.d AS selisih, dbo.tc_bayar_tagih.biaya_transfer, dbo.cek_ver_bdtc_d_v.id_bd_tc_trans
FROM         dbo.cek_ver_bdtc_d_v INNER JOIN
                      dbo.cek_ver_bdtc_k_v ON dbo.cek_ver_bdtc_d_v.id_bd_tc_trans = dbo.cek_ver_bdtc_k_v.id_bd_tc_trans AND 
                      dbo.cek_ver_bdtc_d_v.no_bukti = dbo.cek_ver_bdtc_k_v.no_bukti AND dbo.cek_ver_bdtc_d_v.d <> dbo.cek_ver_bdtc_k_v.K INNER JOIN
                      dbo.tc_bayar_tagih ON dbo.cek_ver_bdtc_k_v.id_bd_tc_trans = dbo.tc_bayar_tagih.id_bd_tc_trans
WHERE     (dbo.cek_ver_bdtc_k_v.K - dbo.cek_ver_bdtc_d_v.d < 10000) AND 
                      (dbo.cek_ver_bdtc_k_v.K - dbo.cek_ver_bdtc_d_v.d = dbo.tc_bayar_tagih.biaya_transfer)
ORDER BY selisih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_ver_bdtc_v]");
    }
};
