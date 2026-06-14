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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_fee_dokter_man_temp_sp]
@id_bd_tc_trans_det as int,
@kode_dokter as int,
@no_induk as int


as
-- input ke tabel 
insert into fee_dokter_rj_umum_temp(kode_dr,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,jumlah,no_induk,id_bd_tc_trans_det,tgl_input)
select kode_dr,no_bukti as no_kuitansi,tgl_transaksi,tgl_transaksi as tgl_kuitansi,kode_bagian,jumlah as jumlah,@no_induk,id_bd_tc_trans_det,GETDATE() as tgl_input
from ver_fee_dokter_manual_v where id_bd_tc_trans_det=@id_bd_tc_trans_det and kode_dr=@kode_dokter;

--update flag_dr di tabel bd_tc_trans_detail
update ver_fee_dokter_manual_v set flag_dr=1 where kode_dr=@kode_dokter and jumlah>0 and id_bd_tc_trans_det=@id_bd_tc_trans_det and id_bd_tc_trans_det in (select id_bd_tc_trans_det from fee_dokter_rj_umum_temp);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_man_temp_sp");
    }
};
