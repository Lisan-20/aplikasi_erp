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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_mt_profit_margin_all_v
AS
SELECT     dbo.profit_margin_umum_v.kode_profit, dbo.profit_margin_umum_v.nama_pelayanan, dbo.profit_margin_umum_v.kode_kelompok, 
                      dbo.profit_margin_umum_v.golongan, dbo.mt_golongan_profit.nama_golongan, dbo.profit_margin_umum_v.profit_umum, 
                      dbo.profit_margin_perusahaan_v.profit_perusahaan, dbo.profit_margin_asuransi_v.profit_asuransi, dbo.profit_margin_bpjs_v.profit_bpjs, 
                      dbo.profit_margin_jamkesda_v.profit_jamkesda
FROM         dbo.profit_margin_umum_v INNER JOIN
                      dbo.profit_margin_perusahaan_v ON dbo.profit_margin_umum_v.kode_profit = dbo.profit_margin_perusahaan_v.kode_profit AND 
                      dbo.profit_margin_umum_v.golongan = dbo.profit_margin_perusahaan_v.golongan INNER JOIN
                      dbo.profit_margin_asuransi_v ON dbo.profit_margin_umum_v.kode_profit = dbo.profit_margin_asuransi_v.kode_profit AND 
                      dbo.profit_margin_umum_v.golongan = dbo.profit_margin_asuransi_v.golongan INNER JOIN
                      dbo.profit_margin_bpjs_v ON dbo.profit_margin_umum_v.kode_profit = dbo.profit_margin_bpjs_v.kode_profit AND 
                      dbo.profit_margin_umum_v.golongan = dbo.profit_margin_bpjs_v.golongan INNER JOIN
                      dbo.mt_golongan_profit ON dbo.profit_margin_umum_v.golongan = dbo.mt_golongan_profit.golongan LEFT OUTER JOIN
                      dbo.profit_margin_jamkesda_v ON dbo.profit_margin_umum_v.kode_profit = dbo.profit_margin_jamkesda_v.kode_profit AND 
                      dbo.profit_margin_umum_v.golongan = dbo.profit_margin_jamkesda_v.golongan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_mt_profit_margin_all_v]");
    }
};
