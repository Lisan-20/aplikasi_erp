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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[jurnal_rawat_jalan_baru_sp]
as
update tran_sed set kode_bagian='060101' where jenis_tindakan=11 and kode_bagian<>'060101' and flag_jurnal is null;
update upd_kode_bagian_asal_v set kode_bagian=kode_bagian_trans;
exec jurnal_tran_kasir_rj_sp;
exec jurnal_tran_sed_RJ_sp;
exec jurnal_tran_sed_diskon_RJ_sp;
exec upd_tran_sed_kasir_sp;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_rawat_jalan_baru_sp");
    }
};
