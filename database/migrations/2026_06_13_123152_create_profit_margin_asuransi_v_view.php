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
        DB::statement("CREATE VIEW dbo.profit_margin_asuransi_v
AS
SELECT     TOP (100) PERCENT kode_kelompok, nama_pelayanan, profit_obat AS profit_asuransi, kode_klas, kode_profit, golongan
FROM         dbo.fr_mt_profit_margin
WHERE     (kode_kelompok = 3)
ORDER BY nama_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [profit_margin_asuransi_v]");
    }
};
