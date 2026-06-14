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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_2013_v
AS
SELECT     TOP (100) PERCENT SUM(tx_nominal) AS tagihan, YEAR(tx_tgl) AS tahun, kode_perusahaan, referensi
FROM         dbo.tx_harian
WHERE     (acc_no = 1130108) AND (YEAR(tx_tgl) = 2013) AND (tx_tipe = 'D')
GROUP BY YEAR(tx_tgl), kode_perusahaan, referensi
ORDER BY kode_perusahaan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_2013_v]");
    }
};
