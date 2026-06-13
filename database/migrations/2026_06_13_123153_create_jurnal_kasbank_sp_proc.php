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
        DB::unprepared("CREATE PROC [dbo].[jurnal_kasbank_sp]
AS
update bd_tc_trans_detail set id_bank=0 where id_bank is null;

exec jurnal_kasbank_D_sp;
exec jurnal_kasbank_K_sp;
UPDATE  tx_harian SET kd_trans_bendahara = 2111 WHERE (kd_trans_bendahara = 1114);
update tx_harian SET ko_wil=101 where ko_wil is null;
exec update_ref_sp;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasbank_sp");
    }
};
