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
        DB::unprepared("CREATE PROCEDURE [dbo].[tarik_kunjungan_sp] 

@no_kunjungan as int

AS

begin	

insert into tc_kunjungan_tarik(id_tc_kunjungan,
no_kunjungan,
no_registrasi,
no_mr,
kode_dokter,
kode_bagian_tujuan,
kode_bagian_asal,
tgl_masuk,
tgl_keluar,
status_masuk,
status_keluar,
status_cito,
keterangan,
status_batal) select id_tc_kunjungan,
no_kunjungan,
no_registrasi,
no_mr,
kode_dokter,
kode_bagian_tujuan,
kode_bagian_asal,
tgl_masuk,
tgl_keluar,
status_masuk,
status_keluar,
status_cito,
keterangan,
status_batal from tc_kunjungan Where no_kunjungan=@no_kunjungan;
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tarik_kunjungan_sp");
    }
};
