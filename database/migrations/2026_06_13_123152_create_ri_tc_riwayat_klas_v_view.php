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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_tc_riwayat_klas_v
AS
SELECT     MAX(kode_riw_klas) AS Expr1, kode_ri, kode_kunjungan, no_registrasi, ket_keluar, status_hidup, kode_kematian, waktu_kematian, tgl_pindah
FROM         dbo.ri_tc_riwayat_kelas
GROUP BY kode_ri, kode_kunjungan, no_registrasi, ket_keluar, status_hidup, kode_kematian, waktu_kematian, tgl_pindah
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_tc_riwayat_klas_v]");
    }
};
