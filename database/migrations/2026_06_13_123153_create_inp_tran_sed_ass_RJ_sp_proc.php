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

CREATE proc [dbo].[inp_tran_sed_ass_RJ_sp]
as
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,bill_rs_jatah as tx_nominal, jumlah,jenis_tindakan,3 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and bill_rs_jatah>0 and jenis_tindakan in(3,4) and nama_tindakan not like 'adm%';
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,bill_rs_jatah as tx_nominal, jumlah,jenis_tindakan,7 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and bill_rs_jatah>0 and jenis_tindakan in(7);
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,bill_rs_jatah as tx_nominal, jumlah,jenis_tindakan,9 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and bill_rs_jatah>0 and jenis_tindakan in(9);
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,bill_rs_jatah as tx_nominal, jumlah,jenis_tindakan,6 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and bill_rs_jatah>0 and jenis_tindakan in(6);

--diskon
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,22 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian_asal as kode_bagian,kode_bagian AS kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(3) and kode_bagian like '05%' ;--disko penunjang medis RI
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,23 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(3,4,15) and (kode_bagian like '01%' or kode_bagian like '02%');--diskon tindakan RI
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,30 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_pelayanan_ass_RJ_v where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(9,7) ;--diskon OBAT RUANGAN, OKSIGEN
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi) select no_registrasi,no_kunjungan,no_mr,diskon_rs as tx_nominal, jumlah,jenis_tindakan,21 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi from v_trans_farmasi_rj_ass where flag_jurnal=0 and diskon_rs>0 and jenis_tindakan in(11) ;--diskon OBAT Farmasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_sed_ass_RJ_sp");
    }
};
