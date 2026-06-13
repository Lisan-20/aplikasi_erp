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
        DB::statement("CREATE VIEW dbo.mt_barang_nm_v
AS
SELECT     dbo.mt_barang_nm.kode_kategori, dbo.mt_barang_nm.satuan_besar, dbo.mt_barang_nm.satuan_kecil, dbo.mt_barang_nm.flag_medis, dbo.mt_barang_nm.jenis_obat, 
                      dbo.mt_barang_nm.jenis_askes, dbo.mt_barang_nm.kode_sub_golongan, dbo.mt_barang_nm.kode_golongan, dbo.mt_barang_nm.id_pabrik, dbo.mt_barang_nm.kode_layanan, 
                      dbo.mt_barang_nm.obat_khusus, dbo.mt_barang_nm.kode_jenis, dbo.mt_barang_nm.[content], dbo.mt_barang_nm.id_barang, dbo.mt_barang_nm.type, dbo.mt_barang_nm.merk, 
                      dbo.mt_barang_nm.buatan, dbo.mt_barang_nm.flag_asset, dbo.mt_barang_nm.inv, dbo.mt_barang_nm.supplier, dbo.mt_barang_nm.sn, dbo.mt_barang_nm.cp, dbo.mt_barang_nm.tglbeli, 
                      dbo.mt_barang_nm.harga_beli, dbo.mt_barang_nm.kode_brg_medis, dbo.mt_barang_nm.flag_jenis, dbo.mt_barang_nm.inv_tehnik, dbo.mt_barang_nm.keterangan, dbo.mt_barang_nm.status, 
                      dbo.mt_golongan_nm.kode_mapp
FROM         dbo.mt_barang_nm INNER JOIN
                      dbo.mt_golongan_nm ON dbo.mt_barang_nm.kode_golongan = dbo.mt_golongan_nm.kode_golongan INNER JOIN
                      dbo.mt_golongan_nm_grup ON dbo.mt_golongan_nm.kode_mapp = dbo.mt_golongan_nm_grup.id_map
WHERE     (dbo.mt_barang_nm.flag_asset = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_nm_v]");
    }
};
