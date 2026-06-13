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
        DB::statement("CREATE VIEW dbo.fr_mt_profit_margin_v
AS
SELECT     dbo.fr_mt_profit_margin.id_profit, dbo.fr_mt_profit_margin.kode_profit, dbo.fr_mt_profit_margin.nama_pelayanan, dbo.fr_mt_profit_margin.tingkat, 
                      dbo.fr_mt_profit_margin.kode_klas, dbo.fr_mt_profit_margin.profit_obat, dbo.fr_mt_profit_margin.profit_alkes, dbo.fr_mt_profit_margin.referensi, 
                      dbo.fr_mt_profit_margin.golongan
FROM         dbo.fr_mt_profit_margin INNER JOIN
                      dbo.mt_barang ON dbo.fr_mt_profit_margin.golongan = dbo.mt_barang.obat_khusus
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_mt_profit_margin_v]");
    }
};
