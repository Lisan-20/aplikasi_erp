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
        DB::unprepared("

CREATE proc [dbo].[inp_tran_sed_adm_RJ_sp]
as
-- administrasi pasien
--update tc_trans_pelayanan set jenis_tindakan=2 where kode_tarif in(501012701,502050101,503010201) and jenis_tindakan=3 and status_selesai=3 and flag_jurnal=0;
update tc_trans_pelayanan set jenis_tindakan=2 where jenis_tindakan=3 and nama_tindakan like 'Administrasi%';
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,bill_rs as tx_nominal, jumlah,jenis_tindakan,2 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_adm_RJ_v where flag_jurnal=0 and bill_rs>0;
--diskon
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,29 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_adm_RJ_v where flag_jurnal=0 and diskon_rs>0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_sed_adm_RJ_sp");
    }
};
