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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_far_new2_sp]
@bln as int,
@thn as int

as

update lap_rekap_resep2_v set opd_BpjsPbi=BpjsPbi, opd_pt=pt, opd_BpjsNonPbi=BpjsNonPbi, opd_asuransi=asuransi where blnnya = @bln and thnnya = @thn
update lap_rekap_resep2_ri_v set  ipd_BpjsPbi=BpjsPbi, ipd_pt=pt, ipd_BpjsNonPbi=BpjsNonPbi, ipd_asuransi=asuransi where blnnya = @bln and thnnya = @thn

update lap_rekap_resep3_v set opd_umum=umum, opd_BpjsKtngkrja=BpjsKtngkrja, opd_BpjsCob=BpjsCob, opd_jamkesda=jamkesda where blnnya = @bln and thnnya = @thn
update lap_rekap_resep3_ri_v set ipd_umum=umum, ipd_BpjsKtngkrja=BpjsKtngkrja, ipd_BpjsCob=BpjsCob, ipd_jamkesda=jamkesda where blnnya = @bln and thnnya = @thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_far_new2_sp");
    }
};
