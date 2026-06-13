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
        DB::unprepared("CREATE proc [dbo].[fee_fisioterapis_nonbpjs_temp_sp]
@kode_trans_pelayanan as int,
@kode_paramedis as int,
@kode_tc_trans_kasir as int,
@no_induk as int

as
-- pasien umum

insert into fee_paramedis_temp(kode_paramedis,no_kunjungan,no_registrasi,no_mr,kode_kelompok,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_umum)
select kode_paramedis,no_kunjungan,no_registrasi,no_mr,kode_kelompok,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam,kode_bagian,nama_tindakan,kode_trans_pelayanan,fee as jumlah,@no_induk,'1' as flag_umum
from v_bill_fisio_nonbpjs where kode_trans_pelayanan=@kode_trans_pelayanan and (kode_paramedis=@kode_paramedis );

update tc_trans_pelayanan set flag_param1=1 where kode_dokter1=@kode_paramedis and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_umum=1);
update tc_trans_kasir set flag_fisio=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir;

update tc_trans_pelayanan set flag_param1=1 where kode_dokter1=@kode_paramedis and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_pt=1);
update tc_trans_kasir set flag_fisio=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir;
update tc_trans_pelayanan set flag_param1=1 where kode_dokter1=@kode_paramedis and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_ass=1);
update tc_trans_kasir set flag_fisio=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir;
update tc_trans_pelayanan set flag_param1=1 where kode_dokter1=@kode_paramedis and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_paramedis_temp where flag_bpjs=1);
update tc_trans_kasir set flag_fisio=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fee_fisioterapis_nonbpjs_temp_sp");
    }
};
