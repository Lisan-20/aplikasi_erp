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
        DB::statement("CREATE VIEW dbo.v_bill_fisio_bpjs
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.bill, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.flag_fee_billing_dr, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.flag_fisio, dbo.tc_trans_pelayanan.kode_paramedis, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.mt_master_tarif.flag_alat, CASE WHEN flag_alat = 1 THEN 5000 ELSE 10000 END AS fee
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.bill, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.flag_fee_billing_dr, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.flag_fisio, 
                      dbo.tc_trans_pelayanan.kode_paramedis, dbo.tc_trans_pelayanan.nama_tindakan, dbo.mt_master_tarif.flag_alat
HAVING      (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_bagian = '050301') AND (NOT (dbo.tc_trans_pelayanan.kode_kelompok IN (1, 3, 5))) AND 
                      (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_kasir.flag_fisio IS NULL) AND (NOT (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'KONSUL%')) AND 
                      (dbo.tc_trans_pelayanan.kode_paramedis IN
                          (SELECT     kode_paramedis
                            FROM          dbo.mt_karyawan
                            WHERE      (kode_paramedis IS NOT NULL) AND (kode_bagian = '050301')))
ORDER BY dbo.tc_trans_pelayanan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bill_fisio_bpjs]");
    }
};
