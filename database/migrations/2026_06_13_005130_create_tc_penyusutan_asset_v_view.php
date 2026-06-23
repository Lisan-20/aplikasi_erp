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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_penyusutan_asset_v
AS
SELECT     dbo.tc_penyusutan_asset.bln, dbo.tc_penyusutan_asset.thn, dbo.tc_penyusutan_asset.kode_barang, dbo.tc_penyusutan_asset.kode_bagian, dbo.tc_penyusutan_asset.asset_type, 
                      dbo.tc_penyusutan_asset.nominal_penyusutan, dbo.tc_penyusutan_asset.acc_d, dbo.tc_penyusutan_asset.no_induk, dbo.tc_penyusutan_asset.acc_k, dbo.mt_barang_jasa.nama_brg, 
                      dbo.mt_barang_jasa.satuan_besar, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.harga_beli, dbo.mt_account.acc_nama AS acc_nama_d, mt_account_1.acc_nama AS acc_nama_k, 
                      dbo.tc_penyusutan_asset.flag_jurnal, dbo.tc_penyusutan_asset.qty
FROM         dbo.tc_penyusutan_asset INNER JOIN
                      dbo.mt_account ON dbo.tc_penyusutan_asset.acc_d = dbo.mt_account.acc_no INNER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.tc_penyusutan_asset.acc_k = mt_account_1.acc_no INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_penyusutan_asset.kode_barang = dbo.mt_barang_jasa.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penyusutan_asset_v]");
    }
};
