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
        DB::statement("
CREATE VIEW dbo.mt_nasabah_v
AS
SELECT     dbo.fr_mt_profit_margin_persh.id_profit_perusahaan, dbo.fr_mt_profit_margin_persh.kode_kelompok, dbo.mt_nasabah.nama_kelompok, 
                      dbo.fr_mt_profit_margin_persh.profit_obat, dbo.fr_mt_profit_margin_persh.profit_alkes, dbo.fr_mt_profit_margin_persh.diskon_obat, 
                      dbo.fr_mt_profit_margin_persh.diskon_kamar, dbo.fr_mt_profit_margin_persh.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.mt_perusahaan RIGHT OUTER JOIN
                      dbo.fr_mt_profit_margin_persh ON dbo.mt_perusahaan.kode_perusahaan = dbo.fr_mt_profit_margin_persh.kode_perusahaan RIGHT OUTER JOIN
                      dbo.mt_nasabah ON dbo.fr_mt_profit_margin_persh.kode_kelompok = dbo.mt_nasabah.kode_kelompok

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_nasabah_v]");
    }
};
