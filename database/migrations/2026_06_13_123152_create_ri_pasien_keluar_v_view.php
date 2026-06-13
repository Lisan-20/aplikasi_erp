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
        DB::statement("CREATE VIEW dbo.ri_pasien_keluar_v
AS
SELECT     TOP (100) PERCENT COUNT(kode_riw_klas) AS jml, kode_riw_klas, DAY(tgl_pindah) AS tgl, MONTH(tgl_pindah) AS bln, YEAR(tgl_pindah) AS thn, ket_keluar AS status, 
                      status_hidup, bagian_tujuan, bagian_asal, kelas_tujuan
FROM         dbo.ri_tc_riwayat_kelas
GROUP BY tgl_pindah, ket_keluar, status_hidup, bagian_tujuan, bagian_asal, kelas_tujuan, kode_riw_klas
HAVING      (ket_keluar > 0)
ORDER BY tgl, bln, thn, status
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_pasien_keluar_v]");
    }
};
