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
        DB::statement("CREATE VIEW dbo.harga_jual_obat_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.obat_khusus, dbo.fr_mt_profit_margin_all_v.nama_pelayanan, dbo.fr_mt_profit_margin_all_v.nama_golongan, 
                      CASE WHEN profit_umum IS NULL THEN 0 ELSE profit_umum END AS profit_umum, CASE WHEN profit_perusahaan IS NULL THEN 0 ELSE profit_perusahaan END AS profit_perusahaan, 
                      CASE WHEN profit_asuransi IS NULL THEN 0 ELSE profit_asuransi END AS profit_asuransi, CASE WHEN profit_bpjs IS NULL THEN 0 ELSE profit_bpjs END AS profit_bpjs, 
                      CASE WHEN profit_jamkesda IS NULL THEN 0 ELSE profit_jamkesda END AS profit_jamkesda, CASE WHEN harga_beli IS NULL THEN 0 ELSE harga_beli END AS harga_beli, 
                      dbo.mt_barang.kode_jenis, dbo.mt_barang.status_aktif, dbo.fr_mt_profit_margin_all_v.kode_profit, dbo.mt_barang.flag_medis, dbo.mt_depo_stok.kode_bagian
FROM         dbo.mt_barang INNER JOIN
                      dbo.fr_mt_profit_margin_all_v ON dbo.mt_barang.obat_khusus = dbo.fr_mt_profit_margin_all_v.golongan INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_jual_obat_v]");
    }
};
