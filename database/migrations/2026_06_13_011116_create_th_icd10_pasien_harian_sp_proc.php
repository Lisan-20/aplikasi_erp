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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[th_icd10_pasien_harian_sp]
@no_registrasi as varchar(10)


as

truncate table th_icd10_pasien_harian_temp;

insert into th_icd10_pasien_harian_temp(tgl_jam, kode_icd, kode_asterik, no_mr, group_depkes, no_registrasi, kode_bagian, kode_dokter, diagnosa, tipe_rl, status_itung, umur, gender, status_hidup, jns_penyakit, tgl_input, user_id, 
                         sys_lama,  no_kunjungan, kode_riwayat)
select tgl_jam, kode_icd, kode_asterik, no_mr, group_depkes, no_registrasi, kode_bagian, kode_dokter, diagnosa, tipe_rl, status_itung, umur, gender, status_hidup, jns_penyakit, tgl_input, user_id, 
                         sys_lama, no_kunjungan, kode_riwayat


from th_icd10_pasien  where no_registrasi=@no_registrasi;

--th_icd10_pasien");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS th_icd10_pasien_harian_sp");
    }
};
