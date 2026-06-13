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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_unit_bln_detail_all_sp]
@bulan as int,
@tahun as int,
@kode_perusahaan as int
--@kode_bagian as varchar(6)

as
exec lap_kunjungan_unit_bln_detail_sp @bulan, @tahun, @kode_perusahaan;
exec lap_kunjungan_unit_bln_detail2_sp @bulan, @tahun, @kode_perusahaan;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_unit_bln_detail_all_sp");
    }
};
