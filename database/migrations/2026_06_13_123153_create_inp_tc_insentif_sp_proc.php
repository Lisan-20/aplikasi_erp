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
create proc inp_tc_insentif_sp
as
insert into tc_insentif(kode_klasifikasi,nama_klasifikasi,bulan,tahun,jumlah_pasien,plafon,fee,id_mt_kategori_ins_det) select kode_klasifikasi,nama_klasifikasi,bulan,tahun,jumlah_pasien,plafon,fee,id_mt_kategori_ins_det from fee_pasien_sum_v;


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tc_insentif_sp");
    }
};
