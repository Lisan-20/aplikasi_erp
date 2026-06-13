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
        DB::unprepared("CREATE proc [dbo].[upd_nasabah_ass_sp]

@no_mr as varchar(6),
@no_registrasi as int,
@kode_perusahaan as int

as

update mt_master_pasien set kode_kelompok=3,kode_perusahaan=@kode_perusahaan  where no_mr=@no_mr;
UPDATE tc_registrasi set kode_kelompok=3,kode_perusahaan=@kode_perusahaan  where no_registrasi=@no_registrasi;
update tc_trans_pelayanan set kode_kelompok=3,kode_perusahaan=@kode_perusahaan,bill_rs_jatah=bill_rs,bill_dr1_jatah=bill_dr1 where no_registrasi=@no_registrasi and (bill_rs_jatah=0 or bill_rs_jatah is null or bill_dr1_jatah=0 or bill_dr1_jatah is null);");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_nasabah_ass_sp");
    }
};
