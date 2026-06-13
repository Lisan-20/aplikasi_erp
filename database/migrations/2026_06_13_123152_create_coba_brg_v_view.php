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
CREATE VIEW dbo.coba_brg_v
AS
SELECT     dbo.mt_barang_RSANNA.[NAMA BARANG] AS nama_brg, dbo.mt_barang_RSANNA.[ID _OBAT] AS id_obat, dbo.mt_barang.nama_brg AS nama_brg2, 
                      dbo.mt_barang.kode_layanan AS kode_layanan2, dbo.mt_barang.kode_brg AS kode_brg2, dbo.mt_barang_RSANNA.KODE_LAYANAN AS kode_layanan, 
                      dbo.mt_barang_RSANNA.KODE_BARANG AS kode_brg
FROM         dbo.mt_barang_RSANNA INNER JOIN
                      dbo.mt_barang ON dbo.mt_barang_RSANNA.[NAMA BARANG] = dbo.mt_barang.nama_brg

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [coba_brg_v]");
    }
};
