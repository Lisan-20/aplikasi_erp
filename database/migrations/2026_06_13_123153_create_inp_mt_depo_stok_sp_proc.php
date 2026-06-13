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
        DB::unprepared("create proc [dbo].[inp_mt_depo_stok_sp]
AS
BEGIN

insert into mt_depo_stok (kode_brg,
jml_sat_kcl,
stok_minimum,
stok_maksimum,
kode_bagian,
kode_rekap_stok,
id_kartu
) select 
kode_brg,
100 as jml_sat_kcl,
stok_minimum,
stok_maksimum,
kode_bagian,
kode_rekap_stok,
id_kartu
from mt_depo_stok_bayangan_v;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_mt_depo_stok_sp");
    }
};
