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
        DB::unprepared("CREATE OR ALTER PROCEDURE pulang_otomatis_sp

@no_registrasi int,
@kode_poli int,
@no_kunjungan int,
@kode_bagian varchar(10)
as
--select @no_registrasi=(select no_registrasi from cek_poli_blm_plg_v);
--select @kode_poli=(select kode_poli from cek_poli_blm_plg_v);
--select @no_kunjungan=(select no_kunjungan from cek_poli_blm_plg_v);
--select @kode_bagian=(select kode_bagian from cek_poli_blm_plg_v);


update tc_trans_pelayanan set status_selesai=2 where no_registrasi=@no_registrasi;
update pl_tc_poli set status_periksa=1 where kode_poli=@kode_poli;
update tc_registrasi set tgl_jam_keluar=GETDATE(),kode_bagian_keluar=@kode_bagian,status_registrasi=1 where no_registrasi=@no_registrasi;
update tc_kunjungan set tgl_keluar=GETDATE(),status_keluar=3 where no_kunjungan=@no_kunjungan;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS pulang_otomatis_sp");
    }
};
