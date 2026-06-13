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
        DB::unprepared("CREATE proc [dbo].[tc_kartu_stok_awal2_sp]
@kode_bagian as varchar(10),
@txt_thn as int,
@txt_bln as int


as

truncate table tc_kartu_stok_awal;

insert into tc_kartu_stok_awal(kode_bagian, kode_brg, stok_awal, id_kartu, thn, bln

)
select kode_bagian, kode_brg, stok_akhir as stok_awal, id_kartu, thn, bln

from tc_kartu_stok_bag_max_v where kode_bagian=@kode_bagian and thn=@txt_thn and bln<@txt_bln;-- 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tc_kartu_stok_awal2_sp");
    }
};
