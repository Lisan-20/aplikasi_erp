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
        DB::statement("CREATE VIEW dbo.aktiva_lancar_kinerja_rs_v
AS
SELECT     SUM(dbo.tx_harian.tx_nominal) AS tx_nominal, dbo.tx_harian.tx_tipe AS tipe, YEAR(dbo.tx_harian.tx_tgl) AS thn, MONTH(dbo.tx_harian.tx_tgl) AS bln, dbo.mt_account.kode_utama, 
                      dbo.mt_account.referensi
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
GROUP BY dbo.tx_harian.tx_tipe, YEAR(dbo.tx_harian.tx_tgl), MONTH(dbo.tx_harian.tx_tgl), dbo.mt_account.kode_utama, dbo.mt_account.referensi
HAVING      (dbo.mt_account.kode_utama = '1') AND (dbo.mt_account.referensi LIKE '11%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [aktiva_lancar_kinerja_rs_v]");
    }
};
