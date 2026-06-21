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
        DB::statement("CREATE OR ALTER VIEW dbo.masuk_manual_bd_tc_v
AS
SELECT     dbo.cek_ver_bdtc_v.no_bukti AS bukti, dbo.cek_ver_bdtc_v.id_bd_tc_trans AS id, dbo.cek_ver_bdtc_v.selisih, dbo.bd_tc_trans_detail.*
FROM         dbo.cek_ver_bdtc_v INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.cek_ver_bdtc_v.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans AND 
                      dbo.cek_ver_bdtc_v.no_bukti = dbo.bd_tc_trans_detail.no_bukti
WHERE     (dbo.bd_tc_trans_detail.tx_tipe = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [masuk_manual_bd_tc_v]");
    }
};
