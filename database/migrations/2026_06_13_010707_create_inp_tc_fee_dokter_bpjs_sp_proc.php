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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_tc_fee_dokter_bpjs_sp]
@no_induk as int

as
if (@no_induk='') set @no_induk = 0;
update upd_kode_plafon set kode_plafon=kode_plafon_asli;
--untuk pasien bpjs yg g byr selisih
-- pasien BPJS Rawat Inap Only
--poli,igd,radiologi
insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon_bpjs,persen,no_induk,tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan)
select kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon as plafon_bpjs,persen,@no_induk,getdate() as tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan
from v_fee_dokter_bpjs_rajal_RI_sum where flag_dr1 is null;

--tindakan inap
insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon_bpjs,persen,no_induk,tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan)
select kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon as plafon_bpjs,persen,@no_induk,getdate() as tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan
from v_fee_dokter_bpjs_RI_tindakan_sum where flag_dr1 is null;

--visit dokter rawat inap
insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon_bpjs,persen,no_induk,tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan)
select kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,(fee_dokter*6/7) as fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon as plafon_bpjs,persen,@no_induk,getdate() as tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan
from v_fee_dokter_bpjs_RI_visit_sum_sum where no_registrasi in (select no_registrasi from dr_umum_v) and flag_dr1 is null;

insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon_bpjs,persen,no_induk,tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan)
select kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,plafon as plafon_bpjs,persen,@no_induk,getdate() as tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan
from v_fee_dokter_bpjs_RI_visit_sum_sum where no_registrasi not in (select no_registrasi from dr_umum_v) and flag_dr1 is null;

--fee dokter untuk pasien yg byr selisih
--v_fee_dokter_bpjs_selisih
insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,persen_dr,no_induk,tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan)
select kode_dokter1 as kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,bill_dr1 as fee_dokter,nama_tindakan,kode_plafon,persen_dr,@no_induk,getdate() as tgl_input,kode_bagian,tgl_transaksi,kode_trans_pelayanan
from v_fee_dokter_bpjs_selisih where flag_dr1 is null;

update tc_trans_pelayanan set flag_dr1=1 where kode_trans_pelayanan in (select kode_trans_pelayanan from tc_fee_dokter_bpjs);

--untuk insentif bpjs
--v_insentif_bpjs_dokter
insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,plafon_bpjs,no_induk,tgl_input,kode_bagian,tgl_transaksi)
select kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,(selisih*10/100/jumlah_dr) as fee_dokter,'Insentif BPJS' as nama_tindakan,kode_plafon,plafon as plafon_bpjs,@no_induk,getdate() as tgl_input,kode_bagian_asal,tgl_transaksi
from v_insentif_bpjs_dokter where  billing_dr < plafon_dr and flag_ins is null;

insert into tc_fee_dokter_bpjs(kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,fee_dokter,nama_tindakan,kode_plafon,plafon_bpjs,no_induk,tgl_input,kode_bagian,tgl_transaksi)
select kode_dr,no_mr,no_kunjungan,no_registrasi,tgl_jam,seri_kuitansi,no_kuitansi,nama_pasien,(selisih*15/100/jumlah_dr) as fee_dokter,'Insentif BPJS' as nama_tindakan,kode_plafon,plafon as plafon_bpjs,@no_induk,getdate() as tgl_input,kode_bagian_asal,tgl_transaksi
from v_insentif_bpjs_dokter where  billing_dr > plafon_dr and flag_ins is null;
update tc_trans_jkn set flag_ins=1 where no_registrasi in (select no_registrasi from tc_fee_dokter_bpjs where nama_tindakan='Insentif BPJS')



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tc_fee_dokter_bpjs_sp");
    }
};
