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
        DB::statement("CREATE VIEW dbo.lap_tc_penyusutan_asset2_v
AS
SELECT     dbo.mt_depo_asset2_v.kode_brg, dbo.mt_depo_asset2_v.kode_bagian, dbo.mt_depo_asset2_v.nama_brg, dbo.mt_depo_asset2_v.satuan_kecil, dbo.mt_depo_asset2_v.asset_type, 
                      dbo.mt_depo_asset2_v.tgl_perolehan, dbo.mt_depo_asset2_v.tgl_pemakaian, dbo.mt_depo_asset2_v.qty, dbo.mt_depo_asset2_v.estimasi_penggunaan, 
                      dbo.mt_depo_asset2_v.metode_penyusutan, dbo.mt_depo_asset2_v.rate, dbo.mt_depo_asset2_v.harga_beli, dbo.mt_depo_asset2_v.nama_bagian, dbo.mt_depo_asset2_v.acc_d, 
                      dbo.mt_depo_asset2_v.acc_k, dbo.mt_depo_asset2_v.satuan_besar, dbo.mt_depo_asset2_v.tahun, dbo.mt_depo_asset2_v.bulan, 
                      dbo.mt_depo_asset2_v.harga_beli * dbo.mt_depo_asset2_v.rate / 100 AS rate_harga, 
                      dbo.mt_depo_asset2_v.harga_beli * dbo.mt_depo_asset2_v.rate / 100 * MONTH(dbo.mt_depo_asset2_v.tgl_perolehan) / 12 AS rate_harga3, dbo.mt_depo_asset2_v.harga_beli AS rate_harga2, 
                      dbo.mt_depo_asset2_v.harga_beli - dbo.mt_depo_asset2_v.harga_beli * dbo.mt_depo_asset2_v.rate / 100 AS harga_pokok, 
                      dbo.mt_depo_asset2_v.harga_beli * dbo.mt_depo_asset2_v.qty AS harga_jumlah, dbo.tc_penyusutan_asset.bln, dbo.tc_penyusutan_asset.thn, 
                      dbo.tc_penyusutan_asset.nominal_penyusutan AS nilai_penyusutan, dbo.mt_depo_asset2_v.kode_aset, YEAR(dbo.mt_depo_asset2_v.tgl_perolehan) AS thn_peroleh, 
                      dbo.mt_depo_asset2_v.tgl_kadaluarsa
FROM         dbo.mt_depo_asset2_v INNER JOIN
                      dbo.tc_penyusutan_asset ON dbo.mt_depo_asset2_v.kode_brg = dbo.tc_penyusutan_asset.kode_barang AND dbo.mt_depo_asset2_v.kode_bagian = dbo.tc_penyusutan_asset.kode_bagian AND 
                      dbo.mt_depo_asset2_v.bulan = dbo.tc_penyusutan_asset.bln AND dbo.mt_depo_asset2_v.tahun = dbo.tc_penyusutan_asset.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_tc_penyusutan_asset2_v]");
    }
};
