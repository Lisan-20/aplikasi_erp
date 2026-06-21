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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_selisih_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.jatah_klas, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.mt_master_tarif_detail.bill_rs AS bill_rs_mt, dbo.mt_master_tarif_detail.bill_dr1 AS bill_dr1_mt, dbo.tc_trans_pelayanan.bill_rs_selisih, 
                      dbo.tc_trans_pelayanan.bill_dr1_selisih, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.bill_rs_p, 
                      dbo.tc_trans_pelayanan.bill_dr_p, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_trans_pelayanan.kode_klas = dbo.ri_tc_rawatinap.kelas_pas INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif AND 
                      dbo.ri_tc_rawatinap.jatah_klas = dbo.mt_master_tarif_detail.kode_klas INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_kunjungan.no_registrasi AND 
                      dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.kode_tarif NOT LIKE '309%') AND (dbo.tc_trans_pelayanan.kode_tarif NOT LIKE '305%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_selisih_v]");
    }
};
