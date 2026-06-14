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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_selisih_asuransi_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.jatah_klas, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.mt_master_tarif_detail_perusahaan.kode_klas, 
                      dbo.mt_master_tarif_detail_perusahaan.bill_rs, dbo.mt_master_tarif_detail_perusahaan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_selisih, 
                      dbo.tc_trans_pelayanan.bill_dr1_selisih, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.bill_rs_p, 
                      dbo.tc_trans_pelayanan.bill_dr_p
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_tarif_detail_perusahaan ON dbo.ri_tc_rawatinap.jatah_klas = dbo.mt_master_tarif_detail_perusahaan.kode_klas AND 
                      dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_perusahaan.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.kode_perusahaan > 0) AND (dbo.tc_trans_pelayanan.kode_tarif NOT LIKE '309%') AND 
                      (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (dbo.ri_tc_rawatinap.kelas_pas < dbo.ri_tc_rawatinap.jatah_klas)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_selisih_asuransi_v]");
    }
};
