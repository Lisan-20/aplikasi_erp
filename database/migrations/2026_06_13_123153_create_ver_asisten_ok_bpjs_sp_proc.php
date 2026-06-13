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
        DB::unprepared("CREATE PROCEDURE [dbo].[ver_asisten_ok_bpjs_sp]
@kode_trans_pelayanan as int,
@kode_paramedis as int,
@no_induk as int,
@fee_ass as int,
@fee_bpjs as int

as

-- pasien paramedis1
insert into fee_paramedis_temp(kode_paramedis,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_umum,kode_kelompok,kode_perusahaan,flag_bedah_bpjs,fee_bpjs)
select @kode_paramedis as kode_paramedis,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam,kode_bagian,nama_tindakan,kode_trans_pelayanan,@fee_ass as jumlah,@no_induk,'1' as flag_umum,kode_kelompok,kode_perusahaan,'1' as flag_bedah_bpjs, @fee_bpjs as fee_bpjs
from fee_asisten_penata_bedah_v where kode_trans_pelayanan=@kode_trans_pelayanan and (kode_paramedis=@kode_paramedis or kode_paramedis is NULL);

update tc_trans_pelayanan set flag_param1=1,kode_paramedis=@kode_paramedis where (kode_paramedis=@kode_paramedis or kode_paramedis is NULL) and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_umum=1);
--update tc_trans_pelayanan set flag_param2=1 where kode_paramedis2=@kode_paramedis and kode_paramedis2>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_umum=1);
--update tc_trans_pelayanan set flag_param3=1 where kode_paramedis3=@kode_paramedis and kode_paramedis3>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_umum=1);

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ver_asisten_ok_bpjs_sp");
    }
};
