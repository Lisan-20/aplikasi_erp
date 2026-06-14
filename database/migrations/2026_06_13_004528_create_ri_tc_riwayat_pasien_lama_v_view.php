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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_tc_riwayat_pasien_lama_v
AS
SELECT     TOP (100) PERCENT dbo.ri_tc_riwayat_pasien_masuk_v.no_mr, dbo.ri_tc_riwayat_pasien_masuk_v.no_registrasi, dbo.ri_tc_riwayat_pasien_masuk_v.no_kunjungan, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.kode_ri, dbo.ri_tc_riwayat_pasien_masuk_v.nama_pasien, dbo.ri_tc_riwayat_pasien_masuk_v.kode_ruangan, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.kode_pelayanan AS x, dbo.ri_tc_riwayat_pasien_masuk_v.kelas_pas, dbo.ri_tc_riwayat_pasien_masuk_v.tgl_masuk, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.dr_merawat, dbo.ri_tc_riwayat_pasien_masuk_v.asal_pasien, dbo.ri_tc_riwayat_pasien_masuk_v.bag_ibu, dbo.ri_tc_riwayat_pasien_masuk_v.kelas_ibu, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.gol_darah, dbo.ri_tc_riwayat_pasien_masuk_v.alergi, dbo.ri_tc_riwayat_pasien_masuk_v.tgl_lhr, dbo.ri_tc_riwayat_pasien_masuk_v.jen_kelamin, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.almt_ttp_pasien, dbo.ri_tc_riwayat_pasien_masuk_v.tgl_keluar, dbo.ri_tc_riwayat_pasien_masuk_v.status_pulang, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.kode_perusahaan, dbo.ri_tc_riwayat_pasien_masuk_v.kode_kelompok, dbo.ri_tc_riwayat_pasien_masuk_v.status_batal, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.tgl_jam_masuk, dbo.ri_tc_riwayat_pasien_masuk_v.Expr1, dbo.ri_tc_riwayat_pasien_masuk_v.tahun, dbo.ri_tc_riwayat_pasien_masuk_v.jumlah, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah AS hari_rawat, dbo.ri_tc_riwayat_pasien_masuk_v.bln, 
                      dbo.ri_tc_riwayat_pasien_masuk_v.kd_bagian AS kode_pelayanan
FROM         dbo.ri_tc_riwayat_pasien_masuk_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.ri_tc_riwayat_pasien_masuk_v.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan AND 
                      dbo.ri_tc_riwayat_pasien_masuk_v.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 1) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE '%ruang%')
ORDER BY dbo.ri_tc_riwayat_pasien_masuk_v.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_tc_riwayat_pasien_lama_v]");
    }
};
