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
        DB::statement("CREATE VIEW dbo.rl_32_gd_v
AS
SELECT     COUNT(no_registrasi) AS jml, DAY(tgl_masuk) AS day, MONTH(tgl_masuk) AS bln, YEAR(tgl_masuk) AS thn, kode_bagian_tujuan AS kode_bagian_keluar, kode_bagian_asal, 
                      kode_bagian_asal AS kode_bagian, tgl_keluar
FROM         dbo.tc_kunjungan
GROUP BY DAY(tgl_masuk), MONTH(tgl_masuk), YEAR(tgl_masuk), kode_bagian_tujuan, kode_bagian_asal, tgl_keluar
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_32_gd_v]");
    }
};
