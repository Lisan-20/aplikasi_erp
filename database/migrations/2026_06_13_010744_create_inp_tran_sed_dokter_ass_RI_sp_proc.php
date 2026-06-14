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

CREATE OR ALTER PROCEDURE [dbo].[inp_tran_sed_dokter_ass_RI_sp]
as
-- jasa dokter rawat inap
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi,harga_beli) select no_registrasi,no_kunjungan,no_mr,bill_dr1_jatah as tx_nominal,jumlah,jenis_tindakan,4 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian_asal as kode_bagian,kode_bagian as kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi,harga_beli from v_trans_pelayanan_ass_RI_v where flag_jurnal=0 and bill_dr1_jatah>0;
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi,harga_beli) select no_registrasi,no_kunjungan,no_mr,bill_dr2_jatah as tx_nominal,jumlah,jenis_tindakan,4 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter2 as kode_dr,kode_trans_far,kode_bagian_asal as kode_bagian,kode_bagian as kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi,harga_beli from v_trans_pelayanan_ass_RI_v where flag_jurnal=0 and bill_dr2_jatah>0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_sed_dokter_ass_RI_sp");
    }
};
