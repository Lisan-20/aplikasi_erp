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
        DB::statement("CREATE OR ALTER VIEW dbo.L_Rugi_bag_5_d_v
AS
SELECT     dbo.tx_harian.acc_no, SUM(dbo.tx_harian.tx_nominal) AS debet, 0 AS kredit, MONTH(dbo.tx_harian.tx_tgl) AS bulan, YEAR(dbo.tx_harian.tx_tgl) AS tahun, dbo.tx_harian.tx_tipe, 
                      dbo.mt_account.referensi, dbo.tx_harian.kode_bagian
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
GROUP BY dbo.tx_harian.acc_no, MONTH(dbo.tx_harian.tx_tgl), YEAR(dbo.tx_harian.tx_tgl), dbo.tx_harian.tx_tipe, dbo.mt_account.referensi, dbo.tx_harian.kode_bagian
HAVING      (dbo.mt_account.referensi LIKE '3%' OR
                      dbo.mt_account.referensi LIKE '4%') AND (dbo.tx_harian.tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_bag_5_d_v]");
    }
};
