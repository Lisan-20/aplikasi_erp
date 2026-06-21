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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_cogs_rawat_jalan_v
AS
SELECT     acc_no, tx_nominal, tx_tipe, no_bukti, tx_tgl, kode_bagian, no_mr, no_registrasi, kel_jurnal, kode_barang, jumlah_barang, flag_cogs
FROM         dbo.tx_harian
WHERE     (acc_no = 3150102) AND (tx_tipe = 'K') AND (kel_jurnal = '1') AND (flag_cogs IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_cogs_rawat_jalan_v]");
    }
};
