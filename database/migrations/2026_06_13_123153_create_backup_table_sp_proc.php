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
        DB::unprepared("create proc [dbo].[backup_table_sp] 

as
--backup yg sdh old
select * into tc_trans_pelayanan_2017 from tc_trans_pelayanan Where YEAR(tgl_transaksi)=2017;
select * into tc_trans_kasir_2017 from tc_trans_kasir Where YEAR(tgl_jam)=2017;
select * into tc_registrasi_2017 from tc_registrasi Where YEAR(tgl_jam_masuk)=2017;
select * into tc_kunjungan_2017 from tc_kunjungan Where YEAR(tgl_masuk)=2017;
select * into fr_tc_far_2017 from fr_tc_far Where YEAR(tgl_trans)=2017;
select * into fr_tc_far_detail_2017 from fr_tc_far_detail Where kode_trans_far in(select kode_trans_far from fr_tc_far Where YEAR(tgl_trans)=2017);
select * into pl_tc_poli_2017 from pl_tc_poli Where YEAR(tgl_jam_poli)=2017;
select * into pm_tc_penunjang_2017 from pm_tc_penunjang Where YEAR(tgl_daftar)=2017;

--delete yg sdh dibackup
delete tc_trans_pelayanan Where YEAR(tgl_transaksi)=2017;
delete tc_trans_kasir Where YEAR(tgl_jam)=2017;
delete tc_registrasi Where YEAR(tgl_jam_masuk)=2017;
delete tc_kunjungan Where YEAR(tgl_masuk)=2017;
delete fr_tc_far_detail Where kode_trans_far in(select kode_trans_far from fr_tc_far Where YEAR(tgl_trans)=2017);
delete fr_tc_far Where YEAR(tgl_trans)=2017;
delete pl_tc_poli Where YEAR(tgl_jam_poli)=2017;
delete pm_tc_penunjang Where YEAR(tgl_daftar)=2017;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS backup_table_sp");
    }
};
