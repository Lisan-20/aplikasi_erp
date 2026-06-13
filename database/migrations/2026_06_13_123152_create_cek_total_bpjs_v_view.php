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
        DB::statement("CREATE VIEW dbo.cek_total_bpjs_v
AS
SELECT     TOP (100) PERCENT kode_tarif, SUM(bill_dr1_bpjs + bill_rs_bpjs) AS total, kode_klas
FROM         dbo.bpjs_bedah_insyaallah
GROUP BY kode_tarif, kode_klas
ORDER BY kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_total_bpjs_v]");
    }
};
