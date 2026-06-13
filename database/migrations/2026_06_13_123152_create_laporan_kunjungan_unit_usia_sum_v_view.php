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
        DB::statement("CREATE VIEW dbo.laporan_kunjungan_unit_usia_sum_v
AS
SELECT     TOP (100) PERCENT kode_bagian, kode_perusahaan, thn, bln, ket, COUNT(ket) AS jum_pasien
FROM         dbo.laporan_kunjungan_unit_usia_v
GROUP BY kode_bagian, kode_perusahaan, thn, bln, ket
ORDER BY thn, bln, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_usia_sum_v]");
    }
};
