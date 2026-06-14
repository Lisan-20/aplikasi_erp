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
        DB::statement("CREATE OR ALTER VIEW dbo.billing_selisih_perusahaan_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.jatah_klas, dbo.ri_tc_rawatinap.kelas_pas, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.mt_master_tarif_detail_pt.bill_rs AS rs, 
                      dbo.mt_master_tarif_detail_pt.bill_dr1 AS dr, dbo.tc_trans_pelayanan.bill_rs_selisih, dbo.tc_trans_pelayanan.bill_dr1_selisih, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.nama_tindakan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_tarif_detail_pt ON dbo.ri_tc_rawatinap.jatah_klas = dbo.mt_master_tarif_detail_pt.kode_klas AND 
                      dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_pt.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.kode_perusahaan > 0) AND (dbo.tc_trans_pelayanan.kode_tarif NOT LIKE '309%')
                       AND (dbo.tc_trans_pelayanan.kode_kelompok = 5) AND (dbo.ri_tc_rawatinap.kelas_pas < dbo.ri_tc_rawatinap.jatah_klas)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_selisih_perusahaan_v]");
    }
};
