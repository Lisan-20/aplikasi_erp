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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_billing_kasir_v
AS
SELECT     dbo.billing_v.kode_tc_trans_kasir, dbo.billing_v.billing, dbo.cek_kasir_v.kasir
FROM         dbo.billing_v INNER JOIN
                      dbo.cek_kasir_v ON dbo.billing_v.kode_tc_trans_kasir = dbo.cek_kasir_v.kode_tc_trans_kasir AND dbo.billing_v.billing = dbo.cek_kasir_v.kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_billing_kasir_v]");
    }
};
