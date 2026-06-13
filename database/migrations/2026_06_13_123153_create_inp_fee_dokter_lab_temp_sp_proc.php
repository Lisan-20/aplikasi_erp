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
        DB::unprepared("CREATE proc [dbo].[inp_fee_dokter_lab_temp_sp]
@kode_trans_pelayanan as int,
@kode_dokter as int,
@no_induk as int

as
-- pasien umum
insert into fee_dokter_rajal_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_umum,kode_kelompok,kode_perusahaan)
select @kode_dokter as kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,kode_perusahaan
from v_dr_lab_umum where kode_trans_pelayanan=@kode_trans_pelayanan and seri_kuitansi in('AJ','RJ');

insert into fee_dokter_rinap_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_umum,kode_kelompok,kode_perusahaan)
select @kode_dokter as kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,kode_perusahaan
from v_dr_lab_umum where kode_trans_pelayanan=@kode_trans_pelayanan and seri_kuitansi in('AI','RI');



-- pasien perusahaan/asuransi
insert into fee_dokter_rajal_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_pt,kode_kelompok,kode_perusahaan)
select @kode_dokter as kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr as jumlah,@no_induk,'1' as flag_pt,kode_kelompok,kode_perusahaan
from v_dr_lab_ptass where kode_trans_pelayanan=@kode_trans_pelayanan and seri_kuitansi in('AJ','RJ');

insert into fee_dokter_rinap_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_pt,kode_kelompok,kode_perusahaan)
select @kode_dokter as kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr as jumlah,@no_induk,'1' as flag_pt,kode_kelompok,kode_perusahaan
from v_dr_lab_ptass where kode_trans_pelayanan=@kode_trans_pelayanan and seri_kuitansi in('AI','RI');

--pasien bpjs
insert into fee_dokter_rajal_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_bpjs,kode_kelompok,kode_perusahaan)
select @kode_dokter as kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr as jumlah,@no_induk,'1' as flag_bpjs,kode_kelompok,kode_perusahaan
from v_dr_lab_bpjs where kode_trans_pelayanan=@kode_trans_pelayanan and seri_kuitansi in('AJ','RJ');

insert into fee_dokter_rinap_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_bpjs,kode_kelompok,kode_perusahaan)
select @kode_dokter as kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr as jumlah,@no_induk,'1' as flag_bpjs,kode_kelompok,kode_perusahaan
from v_dr_lab_bpjs where kode_trans_pelayanan=@kode_trans_pelayanan and seri_kuitansi in('AI','RI');


update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rajal_temp where flag_umum=1 and kode_dr=@kode_dokter);
update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rajal_temp where flag_pt=1 and kode_dr=@kode_dokter);
update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rajal_temp where flag_ass=1 and kode_dr=@kode_dokter);
update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rajal_temp where flag_bpjs=1 and kode_dr=@kode_dokter);

update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rinap_temp where flag_umum=1 and kode_dr=@kode_dokter);
update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rinap_temp where flag_pt=1 and kode_dr=@kode_dokter);
update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rinap_temp where flag_ass=1 and kode_dr=@kode_dokter);
update tc_trans_pelayanan set flag_dr_lab=1 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rinap_temp where flag_bpjs=1 and kode_dr=@kode_dokter);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_lab_temp_sp");
    }
};
