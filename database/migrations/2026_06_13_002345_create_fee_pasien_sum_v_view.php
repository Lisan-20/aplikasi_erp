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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_pasien_sum_v
AS
SELECT     *
FROM       fee_pasien_perina_umum_v
union 
SELECT     *
FROM       fee_pasien_perina_paket_v
union
SELECT     *
FROM       fee_pasien_perina_odc_v
union
SELECT     *
FROM fee_pasien_perina_sc_v
union
SELECT     *
FROM fee_pasien_rawat_umum_v 
union
SELECT     *
FROM fee_pasien_sc_v
union
SELECT     *
FROM fee_pasien_sc_paket_v
union select * from fee_pasien_odc_curet_v
union select * from fee_pasien_rawat_jalan_v



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_pasien_sum_v]");
    }
};
