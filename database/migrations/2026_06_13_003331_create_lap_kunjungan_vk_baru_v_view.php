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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_vk_baru_v
AS
SELECT     TOP (100) PERCENT tgl, bln, thn, kode_bagian, COUNT(no_registrasi) AS baru, stat_pasien
FROM         dbo.lap_kunjungan_ok_tind_v
GROUP BY tgl, bln, thn, kode_bagian, stat_pasien
HAVING      (stat_pasien = 'Baru') AND (kode_bagian = '030501')
ORDER BY bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_vk_baru_v]");
    }
};
