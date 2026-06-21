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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_profit_margin_v
AS
SELECT     fr_mt_profit_margin_1.kode_profit, dbo.fr_mt_profit_margin.nama_pelayanan, fr_mt_profit_margin_1.kode_klas, fr_mt_profit_margin_1.golongan, fr_mt_profit_margin_1.profit_obat, 
                      fr_mt_profit_margin_1.profit_alkes, dbo.fr_mt_profit_margin.profit_obat AS Expr1, dbo.fr_mt_profit_margin.profit_alkes AS Expr2, fr_mt_profit_margin_1.kode_kelompok, 
                      dbo.fr_mt_profit_margin.kode_kelompok AS Expr3
FROM         dbo.fr_mt_profit_margin INNER JOIN
                      dbo.fr_mt_profit_margin AS fr_mt_profit_margin_1 ON dbo.fr_mt_profit_margin.kode_profit = fr_mt_profit_margin_1.kode_profit AND 
                      dbo.fr_mt_profit_margin.golongan = fr_mt_profit_margin_1.golongan
WHERE     (fr_mt_profit_margin_1.kode_kelompok = 1) AND (dbo.fr_mt_profit_margin.kode_kelompok = 10)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_profit_margin_v]");
    }
};
