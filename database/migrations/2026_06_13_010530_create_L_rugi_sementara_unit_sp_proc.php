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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[L_rugi_sementara_unit_sp]

@tahun as int
--sum_L_Rugi_5_Unit_union_v
as

insert into  laba_rugi_sementara_temp(tahun, acc_no, kode_bagian, nama_bagian, nominal, acc_type, bulan)
select @tahun as tahun,  referensi, kode_bagian, nama_bagian, nominal, tx_tipe, bulan
from sum_L_Rugi_5_Unit_union_v where tahun = @tahun


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS L_rugi_sementara_unit_sp");
    }
};
