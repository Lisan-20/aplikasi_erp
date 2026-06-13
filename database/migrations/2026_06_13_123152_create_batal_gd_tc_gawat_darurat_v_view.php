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
        DB::statement("CREATE VIEW dbo.batal_gd_tc_gawat_darurat_v
AS
SELECT     dbo.gd_tc_gawat_darurat.kode_gd, dbo.gd_tc_gawat_darurat.no_kunjungan, dbo.gd_tc_gawat_darurat.kode_penyakit, dbo.gd_tc_gawat_darurat.jns_celaka, dbo.gd_tc_gawat_darurat.tanggal_gd, 
                      dbo.gd_tc_gawat_darurat.tgl_kecelakaan, dbo.gd_tc_gawat_darurat.tmpt_kecelakaan, dbo.gd_tc_gawat_darurat.dibawa_oleh, dbo.gd_tc_gawat_darurat.bentuk_pelayanan, 
                      dbo.gd_tc_gawat_darurat.pemberitahuan_ke, dbo.gd_tc_gawat_darurat.oleh, dbo.gd_tc_gawat_darurat.lapdr_keadaan, dbo.gd_tc_gawat_darurat.pengobatan, 
                      dbo.gd_tc_gawat_darurat.riwayat_singkat, dbo.gd_tc_gawat_darurat.diagnosa_masuk, dbo.gd_tc_gawat_darurat.instruk_penyakit, dbo.gd_tc_gawat_darurat.tgl_jam_msk, 
                      dbo.gd_tc_gawat_darurat.tgl_jam_kel, dbo.gd_tc_gawat_darurat.doa, dbo.gd_tc_gawat_darurat.kd_tind_igd, dbo.gd_tc_gawat_darurat.no_induk, dbo.gd_tc_gawat_darurat.tek_darah, 
                      dbo.gd_tc_gawat_darurat.instr_lanj, dbo.gd_tc_gawat_darurat.instr_pend, dbo.gd_tc_gawat_darurat.asal_pasien, dbo.gd_tc_gawat_darurat.dikirim_oleh, dbo.gd_tc_gawat_darurat.dibawa_dgn, 
                      dbo.gd_tc_gawat_darurat.kasus_polisi, dbo.gd_tc_gawat_darurat.dokter_jaga, dbo.gd_tc_gawat_darurat.nama_org_dekat, dbo.gd_tc_gawat_darurat.telp_org_dekat, 
                      dbo.gd_tc_gawat_darurat.riwayat_kejadian, dbo.gd_tc_gawat_darurat.alamat_org_dekat, dbo.gd_tc_gawat_darurat.status_diterima, dbo.gd_tc_gawat_darurat.kode_klas, 
                      dbo.gd_tc_gawat_darurat.kode_bagian, dbo.gd_tc_gawat_darurat.flag_man, dbo.gd_tc_gawat_darurat.status_periksa, dbo.gd_tc_gawat_darurat_batal.kode_gd AS Expr1
FROM         dbo.gd_tc_gawat_darurat LEFT OUTER JOIN
                      dbo.gd_tc_gawat_darurat_batal ON dbo.gd_tc_gawat_darurat.kode_gd = dbo.gd_tc_gawat_darurat_batal.kode_gd
WHERE     (dbo.gd_tc_gawat_darurat.no_kunjungan IN
                          (SELECT     no_kunjungan
                            FROM          dbo.tc_kunjungan_batal)) AND (dbo.gd_tc_gawat_darurat_batal.kode_gd IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_gd_tc_gawat_darurat_v]");
    }
};
