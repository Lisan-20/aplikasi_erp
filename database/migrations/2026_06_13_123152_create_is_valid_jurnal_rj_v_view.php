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
        DB::statement("CREATE OR ALTER VIEW dbo.is_valid_jurnal_rj_v
AS
SELECT     dbo.validasi_jurnal_kasir_rj_v.kode_tc_trans_kasir
FROM         dbo.validasi_jurnal_billing_rj_v INNER JOIN
                      dbo.validasi_jurnal_kasir_rj_v ON dbo.validasi_jurnal_billing_rj_v.billing = dbo.validasi_jurnal_kasir_rj_v.kasir AND 
                      dbo.validasi_jurnal_billing_rj_v.kode_tc_trans_kasir = dbo.validasi_jurnal_kasir_rj_v.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [is_valid_jurnal_rj_v]");
    }
};
