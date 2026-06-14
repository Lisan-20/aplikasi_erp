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
        DB::statement("CREATE OR ALTER VIEW dbo.pengadaan_bebas_det_v
AS
SELECT     dbo.fr_pengadaan_bebas.id_fr_pengadaan_bebas, dbo.fr_pengadaan_bebas.kode_pengadaan, dbo.fr_pengadaan_bebas.tgl_pembelian, 
                      dbo.fr_pengadaan_bebas.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.fr_pengadaan_bebas.jumlah_kcl, 
                      dbo.fr_pengadaan_bebas.harga_beli, dbo.fr_pengadaan_bebas.total_harga, dbo.fr_pengadaan_bebas.harga_jual, dbo.fr_pengadaan_bebas.induk_bebas, 
                      dbo.fr_pengadaan_bebas.tempat_pembelian, dbo.fr_pengadaan_bebas.petugas
FROM         dbo.fr_pengadaan_bebas INNER JOIN
                      dbo.mt_barang ON dbo.fr_pengadaan_bebas.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengadaan_bebas_det_v]");
    }
};
