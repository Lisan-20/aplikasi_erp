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
        DB::statement("CREATE OR ALTER VIEW dbo.v_billing_dr_fee
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_pelayanan.flag_dr2,
                       dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.bill, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, 
                      CASE WHEN dbo.tc_trans_pelayanan.kode_bagian = '020101' THEN 40000 WHEN dbo.tc_trans_pelayanan.kode_bagian = '011101' THEN 30000 WHEN dbo.tc_trans_pelayanan.kode_bagian
                       = '011001' THEN 26000 END AS fee, dbo.tc_trans_kasir.flag_fee_billing_dr
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (NOT (dbo.tc_trans_pelayanan.kode_tarif IN (201010196, 201010171, 201010172, 201010174, 201010195, 201010191, 201010152, 201010192, 201010171, 
                      201010148, 201010189, 201010176, 201010166, 201010167)))
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_pelayanan.flag_dr2, dbo.tc_trans_pelayanan.kode_dokter2, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.bill, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.flag_fee_billing_dr
HAVING      (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 3) AND (dbo.tc_trans_pelayanan.kode_bagian IN ('020101', '011001', 
                      '011101')) AND (NOT (dbo.tc_trans_pelayanan.kode_kelompok IN (1, 3, 5))) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
ORDER BY dbo.tc_trans_pelayanan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_dr_fee]");
    }
};
