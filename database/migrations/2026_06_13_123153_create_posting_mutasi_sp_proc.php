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
        DB::unprepared("













create proc [dbo].[posting_mutasi_sp]
as

update v_posting_d set mutasi_d = debet;
update v_posting_k set mutasi_k = kredit;
update posting_lev_4_v_d set mutasi_d =jumlah;
update posting_lev_4_v_k set mutasi_k =jumlah;
update posting_lev_3_v_d set mutasi_d =jumlah;
update posting_lev_3_v_k set mutasi_k =jumlah;
update posting_lev_2_v_d set mutasi_d =jumlah;
update posting_lev_2_v_k set mutasi_k =jumlah;
update posting_lev_1_v_d set mutasi_d =jumlah;
update posting_lev_1_v_k set mutasi_k =jumlah;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS posting_mutasi_sp");
    }
};
