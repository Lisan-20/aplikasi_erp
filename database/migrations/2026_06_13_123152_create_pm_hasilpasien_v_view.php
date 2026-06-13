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
        DB::statement("CREATE VIEW dbo.pm_hasilpasien_v
AS
SELECT        dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang, dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm, dbo.pm_tc_hasilpenunjang.hasil, dbo.pm_tc_hasilpenunjang.keterangan, 
                         dbo.pm_tc_hasilpenunjang.kesimpulan, dbo.pm_tc_hasilpenunjang.kesan, dbo.pm_tc_hasilpenunjang.nilai_normal_rujukan, dbo.pm_pemeriksaanpasien_v.status_daftar, dbo.pm_pemeriksaanpasien_v.kode_tc_trans_kasir, 
                         dbo.pm_pemeriksaanpasien_v.no_kunjungan, dbo.pm_pemeriksaanpasien_v.no_registrasi, dbo.pm_pemeriksaanpasien_v.no_mr, dbo.pm_pemeriksaanpasien_v.kode_kelompok, 
                         dbo.pm_pemeriksaanpasien_v.kode_perusahaan, dbo.pm_pemeriksaanpasien_v.tgl_transaksi, dbo.pm_pemeriksaanpasien_v.nama_tindakan, dbo.pm_pemeriksaanpasien_v.kode_bagian, 
                         dbo.pm_pemeriksaanpasien_v.kode_penunjang, dbo.pm_pemeriksaanpasien_v.status_selesai, dbo.pm_pemeriksaanpasien_v.jen_kelamin, dbo.pm_mt_standarhasil.standar_hasil_wanita, 
                         dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_pemeriksaanpasien_v.catatan_hasil, dbo.pm_mt_standarhasil.satuan, dbo.pm_mt_standarhasil.kode_tarif, 
                         dbo.pm_pemeriksaanpasien_v.petugas_isihasil, dbo.pm_pemeriksaanpasien_v.no_hasil_pm, dbo.pm_mt_standarhasil.urutan, dbo.pm_pemeriksaanpasien_v.kode_dokter1, dbo.pm_mt_standarhasil.shw_min, 
                         dbo.pm_mt_standarhasil.shw_max, dbo.pm_mt_standarhasil.shp_min, dbo.pm_mt_standarhasil.shp_max, dbo.pm_mt_standarhasil.flag_std_hasil, dbo.pm_mt_standarhasil.std_text_p, dbo.pm_mt_standarhasil.std_text_l, 
                         dbo.pm_mt_standarhasil.standar_hasil_0_2, dbo.pm_mt_standarhasil.standar_hasil_2_6, dbo.pm_mt_standarhasil.standar_hasil_6_6t, dbo.pm_mt_standarhasil.standar_hasil_6t_18t, dbo.pm_mt_standarhasil.pregnance
FROM            dbo.pm_tc_hasilpenunjang INNER JOIN
                         dbo.pm_pemeriksaanpasien_v ON dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan = dbo.pm_pemeriksaanpasien_v.kode_trans_pelayanan INNER JOIN
                         dbo.pm_mt_standarhasil ON dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_hasilpasien_v]");
    }
};
