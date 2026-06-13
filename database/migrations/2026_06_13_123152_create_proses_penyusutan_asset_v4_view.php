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
        DB::statement("CREATE VIEW dbo.proses_penyusutan_asset_v4
AS
SELECT     dbo.proses_penyusutan_asset_v2.kode_brg, dbo.proses_penyusutan_asset_v2.kode_bagian, dbo.proses_penyusutan_asset_v2.nama_brg, dbo.proses_penyusutan_asset_v2.satuan_kecil, 
                      dbo.proses_penyusutan_asset_v2.asset_type, dbo.proses_penyusutan_asset_v2.tgl_perolehan, dbo.proses_penyusutan_asset_v2.tgl_pemakaian, dbo.proses_penyusutan_asset_v2.qty, 
                      dbo.proses_penyusutan_asset_v2.metode_penyusutan, dbo.proses_penyusutan_asset_v2.estimasi_penggunaan, dbo.proses_penyusutan_asset_v2.harga_beli, 
                      dbo.proses_penyusutan_asset_v2.nama_bagian, dbo.proses_penyusutan_asset_v2.thn_peroleh, dbo.proses_penyusutan_asset_v2.acc_d, dbo.proses_penyusutan_asset_v2.acc_k, 
                      dbo.proses_penyusutan_asset_v2.thn_penyusutan, dbo.proses_penyusutan_asset_v2.satuan_besar, dbo.proses_penyusutan_asset_v2.tahun, dbo.proses_penyusutan_asset_v2.bulan, 
                      dbo.proses_penyusutan_asset_v2.rate_harga, dbo.proses_penyusutan_asset_v2.rate_harga / (dbo.proses_penyusutan_asset_v2.estimasi_penggunaan * 12) AS nilai_penyusutan, 
                      dbo.mt_barang_nm.kode_pabrik, dbo.mt_barang_nm.jenis_askes, dbo.mt_barang_nm.id_pabrik, dbo.mt_barang_nm.kode_golongan, dbo.mt_golongan_nm.nama_golongan, 
                      dbo.mt_barang_nm.buatan, dbo.mt_barang_nm.merk, dbo.mt_barang_nm.type, dbo.mt_barang_nm.supplier, dbo.mt_barang_nm.sn, dbo.mt_barang_nm.inv, dbo.mt_barang_nm.flag_asset
FROM         dbo.proses_penyusutan_asset_v2 INNER JOIN
                      dbo.mt_barang_nm ON dbo.proses_penyusutan_asset_v2.kode_brg = dbo.mt_barang_nm.kode_brg INNER JOIN
                      dbo.mt_golongan_nm ON dbo.mt_barang_nm.kode_golongan = dbo.mt_golongan_nm.kode_golongan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_penyusutan_asset_v4]");
    }
};
