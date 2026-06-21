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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_tindakan_sum_v
AS
SELECT     SUM(bill_rs) AS bill_rs, kode_tc_trans_kasir, no_registrasi
FROM         dbo.tagihan_tindakan_v
GROUP BY kode_tc_trans_kasir, no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_tindakan_sum_v]");
    }
};
