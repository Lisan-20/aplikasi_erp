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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_billing_rad_v
AS
SELECT DISTINCT tx_tgl, no_bukti, kel_jurnal, no_registrasi, kode_tc_trans_kasir, kode_barang
FROM         dbo.tx_harian
WHERE     (kel_jurnal IN ('1', '2')) AND (YEAR(tx_tgl) >= 2014) AND (flag_cogs IS NULL) AND (kode_bagian = '050201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_billing_rad_v]");
    }
};
