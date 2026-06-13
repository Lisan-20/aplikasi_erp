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
        DB::statement("CREATE VIEW dbo.mt_barang_gol_v
AS
SELECT     dbo.mt_barang.id_obat, dbo.mt_barang.kode_brg, dbo.mt_barang.kode_pabrik, dbo.mt_barang.kode_generik, dbo.mt_barang.nama_brg, dbo.mt_barang.kode_kategori, dbo.mt_barang.satuan_besar, 
                      dbo.mt_barang.satuan_kecil, dbo.mt_barang.flag_medis, dbo.mt_barang.jenis_askes, dbo.mt_barang.kode_sub_golongan, dbo.mt_barang.kode_golongan, dbo.mt_barang.id_pabrik, 
                      dbo.mt_barang.kode_layanan, dbo.mt_barang.obat_khusus, dbo.mt_barang.kode_jenis, dbo.mt_barang.[content], dbo.mt_barang.harga_satuan, dbo.mt_barang.kode_rotasi, 
                      dbo.mt_barang.kode_supplier, dbo.mt_barang.sub_content, dbo.mt_barang.satuan_plg_kecil, dbo.mt_barang.on_rp, dbo.mt_barang.on_persen, dbo.mt_barang.off_rp, dbo.mt_barang.off_persen, 
                      dbo.mt_barang.diskon_on, dbo.mt_barang.diskon_off, dbo.mt_barang.status_aktif, dbo.mt_barang.flag_prod, dbo.mt_barang.kode_brg_ref, dbo.mt_barang.rf, dbo.mt_barang.persen_dr, 
                      dbo.mt_barang.gol_obat, dbo.mt_barang.tarif_inhealth, dbo.mt_barang.flag_dpho, dbo.mt_barang.barcode, dbo.mt_barang.user_edit, dbo.mt_barang.tgl_edit, dbo.mt_barang.kode_brg_nonmedis, 
                      dbo.mt_barang.flag_promo, dbo.mt_sub_golongan.nama_sub_golongan, dbo.mt_golongan.nama_golongan, 
                      ISNULL(dbo.mt_golongan.nama_golongan + ' ' + dbo.mt_sub_golongan.nama_sub_golongan, 'BELUM ADA SUB GOLONGAN') AS nama_gol, dbo.mt_barang.satuan_kekuatan, 
                      dbo.mt_barang.kekuatan
FROM         dbo.mt_sub_golongan RIGHT OUTER JOIN
                      dbo.mt_barang ON dbo.mt_sub_golongan.kode_sub_gol = dbo.mt_barang.kode_sub_golongan LEFT OUTER JOIN
                      dbo.mt_golongan ON dbo.mt_barang.kode_golongan = dbo.mt_golongan.kode_golongan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_gol_v]");
    }
};
