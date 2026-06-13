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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pemeriksaan_sum_v
AS
SELECT     TOP (100) PERCENT kode_penunjang, nama_tindakan, SUM(bill_rs_jatah + bill_dr1_jatah) AS tot_bill_rs_jatah, SUM(bill_rs + bill_dr1) AS tot_bill_rs, status_daftar, no_registrasi
FROM         dbo.pm_pemeriksaanpasien_v
WHERE     (status_daftar = 1)
GROUP BY kode_penunjang, nama_tindakan, kode_trans_pelayanan, status_daftar, no_registrasi
HAVING      (nama_tindakan NOT LIKE '%ADMINISTRASI%')
ORDER BY kode_trans_pelayanan, kode_penunjang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaan_sum_v]");
    }
};
