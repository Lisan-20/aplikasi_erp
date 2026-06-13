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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_pelayanan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.no_urut, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_klas, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.ref_bedah, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs AS bill_rs_mt, dbo.mt_master_tarif_detail_bedah.bill_dr1 AS bill_dr1_mt, dbo.mt_master_tarif_detail_bedah.no_urut AS no_urut_mt
FROM         dbo.mt_master_tarif_detail_bedah INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4 = dbo.tc_trans_pelayanan.ref_bedah AND 
                      dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) = 4) AND (dbo.tc_trans_pelayanan.kode_kelompok = 1) AND (dbo.tc_trans_pelayanan.kode_bagian = '030901') AND 
                      (dbo.tc_trans_pelayanan.no_urut = 2) AND (dbo.mt_master_tarif_detail_bedah.no_urut = 3)
ORDER BY dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.kode_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_pelayanan_v]");
    }
};
