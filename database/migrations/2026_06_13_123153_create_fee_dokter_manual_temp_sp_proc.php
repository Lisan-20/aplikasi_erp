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
        DB::unprepared("CREATE proc [dbo].[fee_dokter_manual_temp_sp]
@id_fee_dr_manual as int,
@kode_dokter as int,
@no_induk as int,
@seri_kuitansi as char(2)


as
-- input ke tabel 
if (@seri_kuitansi='RJ')
BEGIN
insert into fee_dokter_rajal_temp(kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,jumlah,no_induk,flag_umum,kode_kelompok,id_fee_dr_manual
)
select kode_dr,no_reg,no_mr,seri_kuitansi,no_kuitansi,tgl_billing,tgl_kuitansi,kode_bag,nama_tarif,bill_dr_real as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,id_fee_dr_manual
from fee_dokter_manual_v where id_fee_dr_manual=@id_fee_dr_manual and kode_dr=@kode_dokter;

update fee_dokter_manual_temp set flag_dr=1, tgl_input= GETDATE(), no_induk=@no_induk where kode_dr=@kode_dokter and id_fee_dr_manual=@id_fee_dr_manual;
END

else if (@seri_kuitansi='AJ')
BEGIN
insert into fee_dokter_rajal_temp(kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,jumlah,no_induk,flag_umum,kode_kelompok,id_fee_dr_manual)
select kode_dr,no_reg,no_mr,seri_kuitansi,no_kuitansi,tgl_billing,tgl_kuitansi,kode_bag,nama_tarif,bill_dr_real as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,id_fee_dr_manual
from fee_dokter_manual_v where id_fee_dr_manual=@id_fee_dr_manual and kode_dr=@kode_dokter;

update fee_dokter_manual_temp set flag_dr=1, tgl_input= GETDATE(), no_induk=@no_induk where kode_dr=@kode_dokter and id_fee_dr_manual=@id_fee_dr_manual;
END

else if (@seri_kuitansi='RI')
BEGIN
insert into fee_dokter_rinap_temp(kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,jumlah,no_induk,flag_umum,kode_kelompok,id_fee_dr_manual)
select kode_dr,no_reg,no_mr,seri_kuitansi,no_kuitansi,tgl_billing,tgl_kuitansi,kode_bag,nama_tarif,bill_dr_real as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,id_fee_dr_manual
from fee_dokter_manual_v where id_fee_dr_manual=@id_fee_dr_manual and kode_dr=@kode_dokter;

update fee_dokter_manual_temp set flag_dr=1, tgl_input= GETDATE(), no_induk=@no_induk where kode_dr=@kode_dokter and id_fee_dr_manual=@id_fee_dr_manual;
END

else if (@seri_kuitansi='AI')
BEGIN
insert into fee_dokter_rinap_temp(kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,jumlah,no_induk,flag_umum,kode_kelompok,id_fee_dr_manual)
select kode_dr,no_reg,no_mr,seri_kuitansi,no_kuitansi,tgl_billing,tgl_kuitansi,kode_bag,nama_tarif,bill_dr_real as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,id_fee_dr_manual
from fee_dokter_manual_v where id_fee_dr_manual=@id_fee_dr_manual and kode_dr=@kode_dokter;

update fee_dokter_manual_temp set flag_dr=1, tgl_input= GETDATE(), no_induk=@no_induk where kode_dr=@kode_dokter and id_fee_dr_manual=@id_fee_dr_manual;
END

--update flag_dr di tabel bd_tc_trans_detail

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fee_dokter_manual_temp_sp");
    }
};
