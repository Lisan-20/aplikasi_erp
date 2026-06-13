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
        DB::unprepared("create proc copy_tarif_bedah_sp
as
insert into mt_master_tarif_detail_bedah
(
kode,
kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total,
detail,
no_urut
)
select 
kode,
kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total,
detail,
no_urut
 from mt_master_tarif_detail_bedah_b
 where kode_tarif not in (select kode_tarif from mt_master_tarif_detail_bedah);");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS copy_tarif_bedah_sp");
    }
};
