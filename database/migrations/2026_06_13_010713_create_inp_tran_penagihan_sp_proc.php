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
        DB::unprepared("CREATE OR ALTER PROCEDURE [inp_tran_penagihan_sp]
as
insert into tran_penagihan(id_tc_tagih,no_bukti,tx_tgl,tx_nominal,kode_perusahaan,kode,tgl_input) select id_tc_tagih,no_invoice_tagih as no_bukti,tgl as tx_tgl,(jumlah + diskon) as tx_nominal,kode_perusahaan,1 as kode,GETDATE() as tgl_input from verifikasi_penagihan_v2 where status_ver=0;
insert into tran_penagihan(id_tc_tagih,no_bukti,tx_tgl,tx_nominal,kode_perusahaan,kode,tgl_input) select id_tc_tagih,no_invoice_tagih as no_bukti,tgl as tx_tgl,(jumlah) as tx_nominal,kode_perusahaan,2 as kode,GETDATE() as tgl_input from verifikasi_penagihan_v2 where status_ver=0;
insert into tran_penagihan(id_tc_tagih,no_bukti,tx_tgl,tx_nominal,kode_perusahaan,kode,tgl_input) select id_tc_tagih,no_invoice_tagih as no_bukti,tgl as tx_tgl,(diskon) as tx_nominal,kode_perusahaan,3 as kode,GETDATE() as tgl_input from verifikasi_penagihan_v2 where status_ver=0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_penagihan_sp");
    }
};
