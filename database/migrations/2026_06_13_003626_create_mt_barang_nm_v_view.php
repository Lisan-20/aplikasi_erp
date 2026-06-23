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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_barang_jasa_v
AS
SELECT     dbo.mt_barang_jasa.kode_kategori, dbo.mt_barang_jasa.satuan_besar, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.flag_medis, dbo.mt_barang_jasa.jenis_obat, 
                      dbo.mt_barang_jasa.jenis_askes, dbo.mt_barang_jasa.kode_sub_golongan, dbo.mt_barang_jasa.kode_golongan, dbo.mt_barang_jasa.id_pabrik, dbo.mt_barang_jasa.kode_layanan, 
                      dbo.mt_barang_jasa.obat_khusus, dbo.mt_barang_jasa.kode_jenis, dbo.mt_barang_jasa.[content], dbo.mt_barang_jasa.id_barang, dbo.mt_barang_jasa.type, dbo.mt_barang_jasa.merk, 
                      dbo.mt_barang_jasa.buatan, dbo.mt_barang_jasa.flag_asset, dbo.mt_barang_jasa.inv, dbo.mt_barang_jasa.supplier, dbo.mt_barang_jasa.sn, dbo.mt_barang_jasa.cp, dbo.mt_barang_jasa.tglbeli, 
                      dbo.mt_barang_jasa.harga_beli, dbo.mt_barang_jasa.kode_brg_medis, dbo.mt_barang_jasa.flag_jenis, dbo.mt_barang_jasa.inv_tehnik, dbo.mt_barang_jasa.keterangan, dbo.mt_barang_jasa.status, 
                      dbo.mt_golongan_nm.kode_mapp
FROM         dbo.mt_barang_jasa INNER JOIN
                      dbo.mt_golongan_nm ON dbo.mt_barang_jasa.kode_golongan = dbo.mt_golongan_nm.kode_golongan INNER JOIN
                      dbo.mt_golongan_nm_grup ON dbo.mt_golongan_nm.kode_mapp = dbo.mt_golongan_nm_grup.id_map
WHERE     (dbo.mt_barang_jasa.flag_asset = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_jasa_v]");
    }
};
