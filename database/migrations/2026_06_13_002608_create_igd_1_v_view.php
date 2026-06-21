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
        DB::statement("CREATE OR ALTER VIEW dbo.igd_1_v
AS
SELECT     kel_jurnal, tx_tipe, flag_cogs, kode_bagian, kode_barang, jumlah_barang, no_registrasi
FROM         dbo.tx_harian
WHERE     (kel_jurnal = '2') AND (tx_tipe = 'K') AND (flag_cogs = 1) AND (kode_bagian LIKE '02%') AND (no_registrasi = 1702180112)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [igd_1_v]");
    }
};
