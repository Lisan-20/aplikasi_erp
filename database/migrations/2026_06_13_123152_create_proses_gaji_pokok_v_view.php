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
        DB::statement("CREATE OR ALTER VIEW dbo.proses_gaji_pokok_v
AS
SELECT     nominal AS nominal_gaji_pokok, npp, id_kd_transaksi
FROM         dbo.tc_transaksi_payroll
GROUP BY npp, id_kd_transaksi, nominal
HAVING      (id_kd_transaksi = N'1') AND (nominal > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_gaji_pokok_v]");
    }
};
