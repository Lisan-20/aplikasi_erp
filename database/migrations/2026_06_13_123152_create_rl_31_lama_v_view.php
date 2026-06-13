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
        DB::statement("CREATE VIEW dbo.rl_31_lama_v
AS
SELECT     COUNT(no_registrasi) AS jml, kode_bagian_tujuan, DAY(tgl_keluar) AS day, MONTH(tgl_keluar) AS bln, YEAR(tgl_keluar) AS thn, DAY(tgl_keluar) - DAY(tgl_masuk) 
                      AS jam
FROM         dbo.tc_kunjungan
GROUP BY kode_bagian_tujuan, status_batal, DAY(tgl_keluar), MONTH(tgl_keluar), YEAR(tgl_keluar), DAY(tgl_keluar) - DAY(tgl_masuk)
HAVING      (status_batal IS NULL) AND (kode_bagian_tujuan LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_31_lama_v]");
    }
};
