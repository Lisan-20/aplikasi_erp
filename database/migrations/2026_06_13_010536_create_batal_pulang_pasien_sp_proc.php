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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[batal_pulang_pasien_sp]
@no_registrasi as int,
@kode_ri as int
as

update tc_kunjungan set status_keluar=null,tgl_keluar=null where no_registrasi=@no_registrasi;
update tc_trans_pelayanan set bill_rs=bill_rs/jumlah , bill_rs_jatah=bill_rs_jatah/jumlah, jumlah=0 where jenis_tindakan=1 and kode_bagian not in('030501','030901') and  no_registrasi=@no_registrasi and tgl_pindah is null;
update ri_tc_rawatinap set status_pulang=0, tgl_keluar=null Where kode_ri = @kode_ri;
--update tc_registrasi set tgl_jam_keluar=null Where no_registrasi = @no_registrasi;
delete tc_trans_pelayanan where no_registrasi=@no_registrasi and jenis_tindakan='2' and nama_tindakan='Biaya Administrasi' and kode_bagian like'03%';
delete tc_trans_pelayanan where no_registrasi=@no_registrasi and jenis_tindakan='14' and nama_tindakan='Asuhan Keperawatan' and kode_bagian like'03%';
update tc_trans_pelayanan set status_selesai=1 Where no_registrasi=@no_registrasi and status_selesai >=1 and status_selesai <3;
--pasien bpjs murni
--delete tc_trans_jkn where no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_pulang_pasien_sp");
    }
};
