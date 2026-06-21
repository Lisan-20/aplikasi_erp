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
        DB::statement("CREATE OR ALTER VIEW dbo.laporan_kunjungan_unit_sex_sum_v
AS
SELECT     kode_bagian, kode_perusahaan, thn, bln, jen_kelamin, COUNT(jen_kelamin) AS jen_kelamin_up
FROM         dbo.laporan_kunjungan_unit_sex_v
GROUP BY kode_bagian, kode_perusahaan, thn, bln, jen_kelamin
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_sex_sum_v]");
    }
};
