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
CREATE PROC [dbo].[diskon_pelayanan_all_sp]


@no_registrasi as int,
@diskon_rs as int,
@pilih_diskon as int


as

if(@pilih_diskon='1')
begin
	update tc_trans_pelayanan_diskon_all_v set diskon_dr1=bill_dr1*@diskon_rs/100 where no_registrasi=@no_registrasi and bill_dr1>0;
end
else if(@pilih_diskon='2')
begin
	update tc_trans_pelayanan_diskon_all_v set diskon_dr2=bill_dr2*@diskon_rs/100 where no_registrasi=@no_registrasi and bill_dr2>0;
end
else if(@pilih_diskon='3')
begin
	update tc_trans_pelayanan_diskon_all_v set diskon_rs=bill_rs*@diskon_rs/100 where no_registrasi=@no_registrasi and bill_rs>0;
end




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS diskon_pelayanan_all_sp");
    }
};
