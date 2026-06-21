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
        DB::unprepared("CREATE OR ALTER PROCEDURE copy_tarif_sp
as
insert into mt_master_tarif_detail 
(kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total)
select
kode_klas,
bill_rs,
bill_dr1,
bill_dr2,
kode_tgl_tarif,
kode_tarif,
total
from mt_master_tarif_detail_b where (kode_tarif like '309%' or kode_tarif like '305%') and kode_tarif not in (select kode_tarif from mt_master_tarif_detail);

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS copy_tarif_sp");
    }
};
