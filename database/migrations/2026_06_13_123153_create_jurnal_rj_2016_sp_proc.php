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
        DB::unprepared("CREATE OR ALTER PROCEDURE jurnal_rj_2016_sp

as
--Semi Jurnal
exec update_kode_bagian_rj_sp;--update kode bagian kasir yg kosong
exec semi_jurnal_partik_RJ_sp;

--Jurnal
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
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_rj_2016_sp");
    }
};
