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

CREATE OR ALTER PROCEDURE [dbo].[inp_tran_sed_far_ass_RI_sp]
as
-- farmasi rawat inap asuransi

/*** Yang retur diganti hasil akhir aja By: Bowo****/
insert into tran_sed (no_registrasi,no_kunjungan,no_mr,tx_nominal,jumlah,jenis_tindakan,kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dr,kode_trans_far,kode_bagian,kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,tgl_input,no_kuitansi,seri_kuitansi,kd_tr_resep) select no_registrasi,no_kunjungan,no_mr,(bill_rs_jatah-bill_rs_jatah_ret) as tx_nominal, (jumlah-jumlah_ret)as jumlah,jenis_tindakan,18 as kode,kode_tc_trans_kasir,kode_barang,nama_tindakan,tgl_jam,kode_dokter1 as kode_dr,kode_trans_far,kode_bagian_asal as kode_bagian,kode_bagian as kode_bagian_asal,kode_trans_pelayanan,kode_kelompok,kode_perusahaan,kode_tarif,getdate() as tgl_input,no_kuitansi,seri_kuitansi,kd_tr_resep from v_trans_farmasi_RI_ass where flag_jurnal=0 and bill_rs_jatah>0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_sed_far_ass_RI_sp");
    }
};
