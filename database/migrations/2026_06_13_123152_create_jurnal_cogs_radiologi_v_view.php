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
        DB::statement("CREATE VIEW dbo.jurnal_cogs_radiologi_v
AS
SELECT     TOP (100) PERCENT dbo.tran_sed.no_registrasi, CASE WHEN dbo.tran_sed.jumlah IS NULL THEN 0 ELSE dbo.tran_sed.jumlah END AS jumlah, CASE WHEN dbo.tran_sed.harga_beli IS NULL 
                      THEN 0 ELSE dbo.tran_sed.harga_beli END AS harga_beli, dbo.tran_sed.nama_tindakan, dbo.tran_sed.no_mr, dbo.tran_sed.seri_kuitansi, dbo.tran_sed.no_kuitansi, 
                      dbo.tran_sed.jumlah AS jumlah_barang, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam AS tx_tgl, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_bagian_asal, dbo.tran_sed.kode_kelompok, 
                      dbo.tran_sed.kode_perusahaan, dbo.jurnal_billing_rad_v.no_bukti, dbo.tran_sed.kode, dbo.tran_sed.kode_trans_pelayanan, dbo.tran_sed.vol, 
                      dbo.tran_sed.vol * dbo.tran_sed.harga_beli AS tx_nominal, dbo.tran_sed.kode_tc_trans_kasir
FROM         dbo.tran_sed INNER JOIN
                      dbo.jurnal_billing_rad_v ON dbo.tran_sed.kode_tc_trans_kasir = dbo.jurnal_billing_rad_v.kode_tc_trans_kasir AND 
                      dbo.tran_sed.kode_barang = dbo.jurnal_billing_rad_v.kode_barang COLLATE SQL_Latin1_General_CP1_CI_AS
WHERE     (YEAR(dbo.tran_sed.tgl_jam) >= 2014) AND (dbo.tran_sed.tx_nominal > 0) AND (dbo.tran_sed.kode_bagian = '050201') AND (dbo.tran_sed.kode = 3) AND 
                      (dbo.tran_sed.kode_bagian_asal NOT LIKE '03%') AND (dbo.tran_sed.vol * dbo.tran_sed.harga_beli > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_cogs_radiologi_v]");
    }
};
