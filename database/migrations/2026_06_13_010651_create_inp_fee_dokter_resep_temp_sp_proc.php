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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_fee_dokter_resep_temp_sp]
@kode_trans_pelayanan as int,
@kode_dokter as int,
@no_induk as int

as
-- persen dokter
insert into fee_dokter_resep_temp(kode_tc_trans_kasir,kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,kode_barang,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_umum,kode_kelompok,kode_perusahaan)
select kode_tc_trans_kasir,kode_dokter1,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam,kode_bagian,kode_barang,nama_tindakan,kode_trans_pelayanan,fee_obat as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,kode_perusahaan
from persen_resep_dr_v2 where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dokter1=@kode_dokter;

update tc_trans_pelayanan set flag_obat=1 where kode_dokter1=@kode_dokter and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from persen_resep_dr_v2);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_resep_temp_sp");
    }
};
