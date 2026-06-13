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
        DB::statement("CREATE VIEW dbo.v_billing_inheat_obat
AS
SELECT     SUM(dbo.tc_trans_pelayanan.bill_rs_jatah) AS bill_rs_jatah, SUM(dbo.tc_trans_pelayanan.bill_dr1_jatah) AS bill_dr1_jatah, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr2_jatah) AS bill_dr2_jatah, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_barang, dbo.mt_barang.nama_brg
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
WHERE     (dbo.tc_trans_pelayanan.kode_perusahaan = 50)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.mt_barang.nama_brg, dbo.tc_kunjungan.kode_tc_trans_kasir
HAVING      (dbo.tc_trans_pelayanan.kode_barang > '0') AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_kasir.flag_tagih = 1) AND (dbo.tc_kunjungan.kode_tc_trans_kasir IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_inheat_obat]");
    }
};
