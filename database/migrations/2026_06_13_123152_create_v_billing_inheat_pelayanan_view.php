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
        DB::statement("CREATE VIEW dbo.v_billing_inheat_pelayanan
AS
SELECT     SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, SUM(dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_kasir.kode_bagian, dbo.mt_bagian.nama_bagian
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_pelayanan.kode_perusahaan = 50)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.flag_tagih, 
                      dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_kasir.tgl_jam, dbo.tc_kunjungan.kode_tc_trans_kasir, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_kasir.kode_bagian, dbo.mt_bagian.nama_bagian
HAVING      (dbo.tc_trans_pelayanan.kode_barang IS NULL OR
                      dbo.tc_trans_pelayanan.kode_barang = '') AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_tc_trans_kasir IS NULL) 
                      AND (dbo.tc_trans_kasir.flag_tagih = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_inheat_pelayanan]");
    }
};
