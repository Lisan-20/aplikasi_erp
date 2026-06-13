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
        DB::statement("CREATE VIEW dbo.jurnal_billing_obat_bebas_v
AS
SELECT DISTINCT tx_tgl, no_bukti, kel_jurnal, no_registrasi, kode_tc_trans_kasir, kode_barang
FROM         dbo.tx_harian
WHERE     (kel_jurnal IN (9)) AND (flag_cogs IS NULL) AND (kode_bagian <> '050201') AND (kode_barang <> '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_billing_obat_bebas_v]");
    }
};
