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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_barang_dua_2
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang_det.kode_pabrik, dbo.mt_barang.kode_generik, dbo.mt_barang.nama_brg, dbo.mt_barang.kode_kategori, 
                      dbo.mt_barang_det.satuan_besar, dbo.mt_barang_det.satuan_kecil, dbo.mt_barang.flag_medis, dbo.mt_barang.jenis_askes, 
                      dbo.mt_barang.kode_sub_golongan, dbo.mt_barang.kode_golongan, dbo.mt_barang_det.id_pabrik, dbo.mt_barang.kode_layanan, 
                      dbo.mt_barang.obat_khusus, dbo.mt_barang.kode_jenis, dbo.mt_barang_det.[content], dbo.mt_barang_det.harga_satuan, dbo.mt_barang.kode_rotasi, 
                      dbo.mt_barang_det.kode_supplier, dbo.mt_barang.sub_content, dbo.mt_barang.satuan_plg_kecil, dbo.mt_barang_det.on_rp, 
                      dbo.mt_barang_det.on_persen, dbo.mt_barang_det.off_rp, dbo.mt_barang_det.off_persen, dbo.mt_barang_det.diskon_on, 
                      dbo.mt_barang_det.diskon_off, dbo.mt_barang_det.status_aktif, dbo.mt_barang.flag_prod, dbo.mt_barang.kode_brg_ref, dbo.mt_barang.rf, 
                      dbo.mt_barang.persen_dr, dbo.mt_barang.gol_obat
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_barang_det ON dbo.mt_barang.kode_brg = dbo.mt_barang_det.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_dua_2]");
    }
};
