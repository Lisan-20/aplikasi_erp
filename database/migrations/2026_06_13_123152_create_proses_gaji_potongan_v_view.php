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
        DB::statement("CREATE VIEW dbo.proses_gaji_potongan_v
AS
SELECT     SUM(CASE WHEN nominal IS NULL THEN 0 ELSE nominal END) AS nominal_potongan, npp, id_kd_transaksi, tgl_akhir
FROM         dbo.tc_transaksi_payroll
GROUP BY npp, id_kd_transaksi, tgl_akhir
HAVING      (id_kd_transaksi = N'3')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_gaji_potongan_v]");
    }
};
