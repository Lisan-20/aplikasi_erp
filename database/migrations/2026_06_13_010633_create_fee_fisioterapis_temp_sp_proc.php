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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[fee_fisioterapis_temp_sp]
@kode_tc_trans_kasir as int,
@kode_paramedis as int,
@bill_dr1 as int,
@no_induk as int

as
-- pasien umum

insert into fee_paramedis_temp(kode_paramedis,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,jumlah, kode_tc_trans_kasir,no_induk,flag_billing_dr,kode_kelompok
)
select kode_paramedis,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_jam,tgl_jam,kode_bagian,'Tindakan Fisioterapi' as nama_tarif,@bill_dr1 as fee, @kode_tc_trans_kasir, @no_induk,'1' as flag_billing_dr,kode_kelompok
from cek_bill_fisio_bpjs_v where kode_tc_trans_kasir=@kode_tc_trans_kasir and kode_paramedis=@kode_paramedis;

update tc_trans_kasir set flag_fisio=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fee_fisioterapis_temp_sp");
    }
};
