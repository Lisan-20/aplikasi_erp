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
        DB::statement("CREATE VIEW dbo.hitung_jumlah_pasien_v
AS
SELECT     TOP (100) PERCENT MONTH(tgl_jam) AS bulan, YEAR(tgl_jam) AS tahun, COUNT(no_registrasi) AS jumlah_pasien
FROM         dbo.tran_sed
GROUP BY MONTH(tgl_jam), YEAR(tgl_jam), jenis_tindakan, flag_jurnal
HAVING      (jenis_tindakan = 1) AND (flag_jurnal = 1)
ORDER BY bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_jumlah_pasien_v]");
    }
};
