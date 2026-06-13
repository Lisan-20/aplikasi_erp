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
        DB::unprepared("CREATE proc [dbo].[inp_fee_dokter_rj_temp_sp]
@kode_trans_pelayanan as int,
@kode_dokter as int,
@no_induk as int

as
-- pasien umum
insert into fee_dokter_rj_umum_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr1-diskon_dr1 as jumlah,@no_induk
from inp_fee_dr1_temp_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;

insert into fee_dokter_rj_umum_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr2-diskon_dr2 as jumlah,@no_induk
from inp_fee_dr2_temp_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;

-- pasien perusahaan
insert into fee_dokter_rj_PT_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr1-diskon_dr1 as jumlah,@no_induk
from inp_fee_dr1_pt_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;

insert into fee_dokter_rj_PT_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr2-diskon_dr2 as jumlah,@no_induk
from inp_fee_dr2_pt_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;


-- pasien asuransi
insert into fee_dokter_rj_asuransi_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr1_jatah-diskon_dr1 as jumlah,@no_induk
from inp_fee_dr_ass_temp_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;

insert into fee_dokter_rj_asuransi_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr2_jatah-diskon_dr2 as jumlah,@no_induk
from inp_fee_dr2_ass_temp_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;

--inp_fee_dr_bpjs_temp_v
insert into fee_dokter_bpjs_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr1_jatah-diskon_dr1 as jumlah,@no_induk
from inp_fee_dr_bpjs_temp_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;
--
insert into fee_dokter_bpjs_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr2_jatah-diskon_dr2 as jumlah,@no_induk
from inp_fee_dr2_bpjs_temp_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;


update tc_trans_pelayanan set flag_dr1=1 where kode_dokter1=@kode_dokter and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_umum_temp);
update tc_trans_pelayanan set flag_dr2=1 where kode_dokter2=@kode_dokter and bill_dr2>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_umum_temp);

--update tc_trans_pelayanan set flag_dr1=1 where kode_dokter1=@kode_dokter and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_PT_temp);
--update tc_trans_pelayanan set flag_dr2=1 where kode_dokter2=@kode_dokter and bill_dr2>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_PT_temp);

update tc_trans_pelayanan set flag_dr1=1 where kode_dokter1=@kode_dokter and bill_dr1_jatah>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_PT_temp);
update tc_trans_pelayanan set flag_dr2=1 where kode_dokter2=@kode_dokter and bill_dr2_jatah>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_PT_temp);


update tc_trans_pelayanan set flag_dr1=1 where kode_dokter1=@kode_dokter and bill_dr1_jatah>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_asuransi_temp);
update tc_trans_pelayanan set flag_dr2=1 where kode_dokter2=@kode_dokter and bill_dr2_jatah>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_asuransi_temp);

update tc_trans_pelayanan set flag_dr1=1 where kode_dokter1=@kode_dokter and bill_dr1_jatah>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_bpjs_temp);
update tc_trans_pelayanan set flag_dr2=1 where kode_dokter2=@kode_dokter and bill_dr2_jatah>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_bpjs_temp);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_rj_temp_sp");
    }
};
