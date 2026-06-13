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
        DB::statement("CREATE VIEW dbo.v_jurnal_cogs_ri
AS
SELECT     TOP (100) PERCENT dbo.tx_harian.acc_no, SUM(CASE WHEN tx_nominal IS NULL THEN 0 ELSE tx_nominal END) AS tx_nominal, dbo.tx_harian.tx_tgl, 
                      dbo.tx_harian.tx_jam, dbo.tx_harian.tx_tipe, dbo.tx_harian.no_jurnal, dbo.tx_harian.no_det_jurnal, dbo.tx_harian.no_bukti, dbo.tx_harian.kode_bagian, 
                      dbo.tx_harian.no_induk, dbo.tx_harian.kel_jurnal, dbo.tx_harian.no_mr, dbo.tx_harian.no_registrasi, dbo.tx_harian.kode_perusahaan, 
                      dbo.tx_harian.kode_tc_trans_kasir, dbo.tx_harian.kode_supplier, dbo.tx_harian.kode_dr, dbo.tx_harian.kode_barang, dbo.tx_harian.kode_bank, 
                      dbo.tx_harian.referensi, dbo.tx_harian.flag_k, dbo.tx_harian.flag_posting, dbo.tx_harian.kd_trans_bendahara, dbo.tx_harian.kd_group_trans, 
                      dbo.tx_harian.flag_realisasi, SUM(CAST(CASE WHEN tx_harian.jumlah_barang IS NULL THEN 0 ELSE tx_harian.jumlah_barang END AS int)) AS jumlah_barang, 
                      dbo.tx_harian.flag_rekon, dbo.tx_harian.user_rekon, dbo.tx_harian.id_rekon, dbo.tx_harian.flag_balik_rj, dbo.tx_harian.kode_rekon, dbo.tx_harian.tgl_bank, 
                      dbo.tx_harian.id_pajak, dbo.tx_harian.flag_pajak, dbo.tx_harian.flag_b, dbo.tx_harian.flag_cogs, SUM(CAST(CASE WHEN tc_trans_pelayanan.harga_beli IS NULL 
                      THEN 0 ELSE tc_trans_pelayanan.harga_beli END / CASE WHEN tx_harian.jumlah_barang IS NULL THEN 0 ELSE tx_harian.jumlah_barang END AS numeric)) 
                      AS harga_beli, SUM(CAST(CASE WHEN tc_trans_pelayanan.harga_beli IS NULL 
                      THEN 0 ELSE tc_trans_pelayanan.harga_beli END / CASE WHEN tx_harian.jumlah_barang IS NULL THEN 0 ELSE tx_harian.jumlah_barang END AS numeric)) 
                      AS nominal, CAST(CASE WHEN jumlah_barang IS NULL THEN 0 ELSE jumlah_barang END AS int) AS jml_brg
FROM         dbo.tx_harian INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tx_harian.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir AND 
                      dbo.tx_harian.kode_barang = dbo.tc_trans_pelayanan.kode_barang COLLATE Latin1_General_CI_AS AND 
                      dbo.tx_harian.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
GROUP BY dbo.tx_harian.acc_no, dbo.tx_harian.tx_tgl, dbo.tx_harian.tx_jam, dbo.tx_harian.tx_tipe, dbo.tx_harian.no_jurnal, dbo.tx_harian.no_det_jurnal, 
                      dbo.tx_harian.no_bukti, dbo.tx_harian.kode_bagian, dbo.tx_harian.no_induk, dbo.tx_harian.kel_jurnal, dbo.tx_harian.no_mr, dbo.tx_harian.no_registrasi, 
                      dbo.tx_harian.kode_perusahaan, dbo.tx_harian.kode_tc_trans_kasir, dbo.tx_harian.kode_supplier, dbo.tx_harian.kode_dr, dbo.tx_harian.kode_barang, 
                      dbo.tx_harian.kode_bank, dbo.tx_harian.referensi, dbo.tx_harian.flag_k, dbo.tx_harian.flag_posting, dbo.tx_harian.kd_trans_bendahara, 
                      dbo.tx_harian.kd_group_trans, dbo.tx_harian.flag_realisasi, dbo.tx_harian.flag_rekon, dbo.tx_harian.user_rekon, dbo.tx_harian.id_rekon, dbo.tx_harian.flag_balik_rj, 
                      dbo.tx_harian.kode_rekon, dbo.tx_harian.tgl_bank, dbo.tx_harian.id_pajak, dbo.tx_harian.flag_pajak, dbo.tx_harian.flag_b, dbo.tx_harian.flag_cogs, 
                      CAST(CASE WHEN jumlah_barang IS NULL THEN 0 ELSE jumlah_barang END AS int), dbo.tc_trans_pelayanan.status_kredit
HAVING      (dbo.tx_harian.kel_jurnal = '2') AND (dbo.tx_harian.kode_barang <> '') AND (dbo.tx_harian.flag_cogs IS NULL) AND 
                      (SUM(CAST(CASE WHEN tc_trans_pelayanan.harga_beli IS NULL THEN 0 ELSE tc_trans_pelayanan.harga_beli END / CASE WHEN tx_harian.jumlah_barang IS NULL 
                      THEN 0 ELSE tx_harian.jumlah_barang END AS numeric)) > 0) AND (SUM(CAST(CASE WHEN tx_harian.jumlah_barang IS NULL 
                      THEN 0 ELSE tx_harian.jumlah_barang END AS int)) > 0) AND (CAST(CASE WHEN jumlah_barang IS NULL THEN 0 ELSE jumlah_barang END AS int) > 0) AND 
                      (dbo.tc_trans_pelayanan.status_kredit = 0)
ORDER BY dbo.tx_harian.kel_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_cogs_ri]");
    }
};
