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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[tc_kartu_stok_awal_sp]
@kode_bagian as varchar(10),
@txt_thn as int


as

truncate table tc_kartu_stok_awal;

insert into tc_kartu_stok_awal(kode_bagian, kode_brg, stok_awal, id_kartu, thn

)
select kode_bagian, kode_brg, stok_akhir as stok_awal, id_kartu, @txt_thn as thn

from tc_kartu_stok_bag_max_v where kode_bagian=@kode_bagian and thn=@txt_thn;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tc_kartu_stok_awal_sp");
    }
};
