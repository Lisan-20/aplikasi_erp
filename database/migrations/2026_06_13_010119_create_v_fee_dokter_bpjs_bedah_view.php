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
        DB::statement("CREATE OR ALTER VIEW dbo.v_fee_dokter_bpjs_bedah
AS
SELECT     COUNT(dbo.tc_trans_pelayanan.kode_dokter1) AS jumlah_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_trans_jkn.plafon, dbo.tc_trans_jkn.id_jenis_layanan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.flag_dr1, 
                      dbo.tbl_persentase_bedah.persen_dr, dbo.mt_plafon_bpjs_detail.kode_plafon
FROM         dbo.tbl_persentase_bedah INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.tbl_persentase_bedah.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon AND 
                      dbo.tbl_persentase_bedah.id_jenis_layanan = dbo.mt_plafon_bpjs_detail.id_jenis_layanan INNER JOIN
                      dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter ON 
                      dbo.tbl_persentase_bedah.kode_spesialisasi = dbo.mt_karyawan.kode_spesialisasi AND 
                      dbo.mt_plafon_bpjs_detail.id_jenis_layanan = dbo.mt_bagian.id_jenis_layanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_jkn.plafon, dbo.tc_trans_jkn.id_jenis_layanan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.flag_dr1, dbo.tbl_persentase_bedah.persen_dr, dbo.mt_plafon_bpjs_detail.kode_plafon
HAVING      (dbo.tc_trans_pelayanan.kode_kelompok = 9) AND (dbo.tc_trans_pelayanan.kode_bagian IN ('030501', '030901')) AND (dbo.tc_trans_jkn.id_jenis_layanan IN (3, 5)) 
                      AND (dbo.mt_plafon_bpjs_detail.kode_plafon IN (3, 6, 7))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_bedah]");
    }
};
