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
        DB::statement("CREATE VIEW dbo.hitung_hari_rawat_v
AS
SELECT     TOP (100) PERCENT MONTH(tgl_jam) AS bulan, YEAR(tgl_jam) AS tahun, SUM(jumlah) AS hari_rawat
FROM         dbo.tran_sed
GROUP BY MONTH(tgl_jam), YEAR(tgl_jam), jenis_tindakan, kode_bagian, flag_jurnal
HAVING      (jenis_tindakan = 1) AND (kode_bagian NOT IN ('030501', '030901')) AND (flag_jurnal = 1)
ORDER BY bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_hari_rawat_v]");
    }
};
