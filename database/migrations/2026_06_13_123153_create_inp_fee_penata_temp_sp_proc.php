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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_fee_penata_temp_sp]
@kode_trans_pelayanan as int,
@kode_dokter as int,
@no_induk as int,
@fee as int

as
-- pasien umum
insert into fee_paramedis_temp(kode_paramedis,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_penata,kode_kelompok,kode_perusahaan)
select kode_dokter,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam as tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,@fee as jumlah,@no_induk,'1' as flag_penata,kode_kelompok,kode_perusahaan
from fee_penata_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dokter=@kode_dokter;



update tc_trans_pelayanan set flag_penata=1 where kode_dokter1=@kode_dokter and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_penata=1);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_penata_temp_sp");
    }
};
