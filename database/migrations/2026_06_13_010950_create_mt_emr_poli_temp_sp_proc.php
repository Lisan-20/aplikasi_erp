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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[mt_emr_poli_temp_sp]
@kode_bagian as varchar(50)


as

truncate table mt_emr_bedah_temp;

insert into mt_emr_bedah_temp( no_urut, kode_bagian, no_urut_form, nama_form, url, icon, url_cetakan, kode_rm, url_edit, url_cetakan_his, url_implementasi)

select   no_urut, kode_bagian, no_urut_form, nama_form, url, icon, url_cetakan, kode_rm, url_edit, url_cetakan_his, url_implementasi




from mt_emr_unit_v  where kode_bagian=@kode_bagian;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS mt_emr_poli_temp_sp");
    }
};
