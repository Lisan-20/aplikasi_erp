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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[update_ref_sp]
as
--update tgl jatuh tempo hutang
update upd_tgl_jatuh_tempo_v set tgl_tempo=tgl_jt;
update upd_tgl_jatuh_tempo_ht_v set tgl_tempo=tgl_jt;

--update tgl tempo piutang
update upd_jatuh_tempo_penagihan_v set tgl_tempo=tgl_jt_tempo;
update upd_jatuh_tempo_penagihan_man_v set tgl_tempo=tgl_jt_tempo;

update upd_ref_kartu_hutang_v set referensi=no_voucher where referensi is null;
update upd_ref_kartu_piutang_v set referensi=no_invoice_tagih where referensi is null;
update upd_ref_kartu_hutang_sementara_v set referensi=no_voucher where referensi is null;
update upd_ref_hutang_dokter_sementara_1_v set referensi=no_sppu where referensi is null;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS update_ref_sp");
    }
};
