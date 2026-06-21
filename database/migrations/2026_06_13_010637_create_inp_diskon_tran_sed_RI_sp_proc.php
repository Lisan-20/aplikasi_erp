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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_diskon_tran_sed_RI_sp]
as
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,20 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_RI_v where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(1) and kode_bagian like '03%';--diskon RUANGAN
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,23 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_RI_v where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(3,4,15,14,13) and kode_bagian like '03%';--diskon tindakan dan sarana rs
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,22 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian_asal as kode_bagian,kode_bagian AS kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_RI_v where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(3) and kode_bagian like '05%';--diskon penunjang medis

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_diskon_tran_sed_RI_sp");
    }
};
