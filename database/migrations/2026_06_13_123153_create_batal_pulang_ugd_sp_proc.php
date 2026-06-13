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
        DB::unprepared("CREATE proc [dbo].[batal_pulang_ugd_sp]
@no_kunjungan as int,
@no_registrasi as int
as
update tc_kunjungan set tgl_keluar=null,status_keluar=null where no_kunjungan in (select no_kunjungan from batal_pulang_ugd_v) and no_kunjungan=@no_kunjungan;
update tc_trans_pelayanan set status_selesai=0 where no_kunjungan in (select no_kunjungan from batal_pulang_ugd_v) and kode_bagian like '02%' and no_kunjungan=@no_kunjungan;
DELETE gd_th_rujuk_ri  where no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_pulang_ugd_sp");
    }
};
