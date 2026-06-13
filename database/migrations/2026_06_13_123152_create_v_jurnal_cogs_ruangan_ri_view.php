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
        DB::statement("CREATE VIEW dbo.v_jurnal_cogs_ruangan_ri
AS
SELECT     TOP (100) PERCENT dbo.tran_sed.no_registrasi, SUM(CASE WHEN dbo.tran_sed.jumlah IS NULL THEN 0 ELSE dbo.tran_sed.jumlah END) AS jumlah_barang, 
                      SUM(CASE WHEN dbo.tran_sed.harga_beli IS NULL THEN 0 ELSE dbo.tran_sed.harga_beli END) AS harga_beli, dbo.tran_sed.nama_tindakan, dbo.tran_sed.no_mr, dbo.tran_sed.seri_kuitansi, 
                      dbo.tran_sed.no_kuitansi, SUM(dbo.tran_sed.jumlah) AS jumlah, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam AS tx_tgl, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_bagian_asal, 
                      dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.jurnal_billing_v.tx_tgl AS Expr2, dbo.jurnal_billing_v.no_bukti, dbo.jurnal_billing_v.kel_jurnal, 
                      dbo.jurnal_billing_v.kode_tc_trans_kasir
FROM         dbo.tran_sed INNER JOIN
                      dbo.jurnal_billing_v ON dbo.tran_sed.kode_tc_trans_kasir = dbo.jurnal_billing_v.kode_tc_trans_kasir AND 
                      dbo.tran_sed.kode_barang COLLATE Latin1_General_CI_AS = dbo.jurnal_billing_v.kode_barang
WHERE     (dbo.tran_sed.jenis_tindakan IN (9)) AND (dbo.tran_sed.kode = 9) AND (dbo.tran_sed.tx_nominal > 0)
GROUP BY dbo.tran_sed.no_registrasi, dbo.tran_sed.nama_tindakan, dbo.tran_sed.no_mr, dbo.tran_sed.seri_kuitansi, dbo.tran_sed.no_kuitansi, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam, 
                      dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_bagian_asal, dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.jurnal_billing_v.tx_tgl, dbo.jurnal_billing_v.no_bukti, 
                      dbo.jurnal_billing_v.kel_jurnal, dbo.jurnal_billing_v.kode_tc_trans_kasir
HAVING      (YEAR(dbo.tran_sed.tgl_jam) >= 2014) AND (dbo.jurnal_billing_v.kel_jurnal = '2')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_cogs_ruangan_ri]");
    }
};
