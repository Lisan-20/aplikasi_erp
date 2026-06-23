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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_penyusutan_asset_v
AS
SELECT     dbo.tc_penyusutan_asset.kode_barang, dbo.tc_penyusutan_asset.bln, dbo.tc_penyusutan_asset.thn, dbo.tc_penyusutan_asset.nominal_penyusutan, dbo.tc_penyusutan_asset.acc_d, 
                      dbo.tc_penyusutan_asset.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_penyusutan_asset.asset_type, dbo.tc_penyusutan_asset.acc_k, dbo.tc_penyusutan_asset.id_tc_penyusutan_asset, 
                      dbo.tc_penyusutan_asset.qty, dbo.tc_penyusutan_asset.flag_jurnal, dbo.mt_barang_jasa.nama_brg, CAST(dbo.tc_penyusutan_asset.bln AS varchar) 
                      + '/' + '25' + '/' + CAST(dbo.tc_penyusutan_asset.thn AS varchar) AS tgl_proses
FROM         dbo.tc_penyusutan_asset INNER JOIN
                      dbo.mt_bagian ON dbo.tc_penyusutan_asset.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_penyusutan_asset.kode_barang = dbo.mt_barang_jasa.kode_brg
WHERE     (dbo.tc_penyusutan_asset.nominal_penyusutan > 0) AND (dbo.tc_penyusutan_asset.thn >= 2022) AND (dbo.tc_penyusutan_asset.flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_penyusutan_asset_v]");
    }
};
