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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pemeriksaan_adm_sum_v
AS
SELECT     TOP (100) PERCENT kode_penunjang, nama_tindakan, SUM(bill_rs_jatah) AS tot_bill_rs_jatah, SUM(bill_rs) AS tot_bill_rs, status_daftar
FROM         dbo.pm_pemeriksaanpasien_v
GROUP BY kode_penunjang, nama_tindakan, kode_trans_pelayanan, status_daftar
HAVING      (nama_tindakan LIKE '%ADMINISTRASI%')
ORDER BY kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaan_adm_sum_v]");
    }
};
