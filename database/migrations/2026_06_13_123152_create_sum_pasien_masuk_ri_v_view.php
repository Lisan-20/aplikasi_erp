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
        DB::statement("CREATE VIEW dbo.sum_pasien_masuk_ri_v
AS
SELECT     COUNT(no_registrasi) AS jumlah, MONTH(tgl_masuk) AS bulan, YEAR(tgl_masuk) AS thn, kode_bagian_tujuan
FROM         dbo.lap_kunjungan_pasien_v
GROUP BY YEAR(tgl_masuk), MONTH(tgl_masuk), kode_bagian_tujuan
HAVING      (kode_bagian_tujuan LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_pasien_masuk_ri_v]");
    }
};
