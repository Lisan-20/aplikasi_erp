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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_gol_obat_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_barang.obat_khusus, dbo.upd_golongan_obat.F5 AS golongan, dbo.mt_golongan_profit.nama_golongan, dbo.upd_golongan_obat.JENIS
FROM         dbo.mt_barang INNER JOIN
                      dbo.upd_golongan_obat ON dbo.mt_barang.nama_brg = dbo.upd_golongan_obat.[NAMA OBAT] INNER JOIN
                      dbo.mt_golongan_profit ON dbo.upd_golongan_obat.F5 = dbo.mt_golongan_profit.golongan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_gol_obat_v]");
    }
};
