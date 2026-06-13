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
        DB::statement("CREATE VIEW dbo.L_Rugi_5_D_Unit_v
AS
SELECT     dbo.tx_harian.acc_no, SUM(dbo.tx_harian.tx_nominal) AS debet, MONTH(dbo.tx_harian.tx_tgl) AS bulan, YEAR(dbo.tx_harian.tx_tgl) AS tahun, dbo.tx_harian.tx_tipe, 
                      dbo.mt_account.referensi, dbo.tx_harian.kode_bagian, dbo.v_bagian_profit.nama_bagian, dbo.v_bagian_profit.kd_bag_unit, dbo.tx_harian.ko_wil
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no INNER JOIN
                      dbo.v_bagian_profit ON dbo.tx_harian.kode_bagian = dbo.v_bagian_profit.kode_bagian
GROUP BY dbo.tx_harian.acc_no, MONTH(dbo.tx_harian.tx_tgl), YEAR(dbo.tx_harian.tx_tgl), dbo.tx_harian.tx_tipe, dbo.mt_account.referensi, dbo.tx_harian.kode_bagian, 
                      dbo.v_bagian_profit.nama_bagian, dbo.v_bagian_profit.kd_bag_unit, dbo.tx_harian.ko_wil
HAVING      (dbo.mt_account.referensi LIKE '3%' OR
                      dbo.mt_account.referensi LIKE '4%') AND (dbo.tx_harian.tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_5_D_Unit_v]");
    }
};
