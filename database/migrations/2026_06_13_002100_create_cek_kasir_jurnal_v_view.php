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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_kasir_jurnal_v
AS
SELECT DISTINCT no_registrasi, tx_tgl, no_bukti
FROM         dbo.tx_harian
WHERE     (kel_jurnal = 2) AND (no_bukti NOT LIKE 'UM%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_kasir_jurnal_v]");
    }
};
