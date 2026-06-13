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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[mt_rekap_stok_temp_sp]
@kode_bagian as varchar(10),
@txt_bln as int,
@txt_thn as int


as

truncate table mt_rekap_stok_temp;

insert into mt_rekap_stok_temp(kode_bagian, kode_brg, bln, thn, saldo_awal, pemasukan, pengeluaran, saldo_akhir, nama_barang, sat_kecil

)
select kode_bagian, kode_brg, @txt_bln  as bln, @txt_thn as thn, 0 as saldo_awal, 0 as pemasukan, 0 as pengeluaran, 0 as saldo_akhir, nama_brg as nama_barang, satuan_kecil as sat_kecil

from mt_depo_stok_v where kode_bagian=@kode_bagian;

----------
--update update_saldo_awal_kartu_stok_v set saldo_awal=stok_awal
update update_mutasi_kartu_stok_v set pemasukan=pemasukan_up, pengeluaran=pengeluaran_up
						 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS mt_rekap_stok_temp_sp");
    }
};
