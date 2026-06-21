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
        DB::statement("CREATE OR ALTER VIEW dbo.obat_konversi_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, mt_barang_1.kode_brg AS kode_brg_bsr, mt_barang_1.nama_brg AS nama_brg_bsr, 
                      mt_barang_1.satuan_kecil AS satuan_kecil_bsr, dbo.mt_barang.flag_medis
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_barang AS mt_barang_1 ON dbo.mt_barang.kode_brg_ref = mt_barang_1.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_konversi_v]");
    }
};
