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
        DB::unprepared("CREATE proc [dbo].[th_icd9_pasien_harian_sp]
@no_registrasi as varchar(10)


as

truncate table th_icd9_pasien_harian_temp;

insert into th_icd9_pasien_harian_temp(nama_icd9, kode_icd9, no_registrasi, tgl_jam
)
select nama_icd9, kode_icd9, no_registrasi, tgl_jam


from th_icd9_pasien_v  where no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS th_icd9_pasien_harian_sp");
    }
};
