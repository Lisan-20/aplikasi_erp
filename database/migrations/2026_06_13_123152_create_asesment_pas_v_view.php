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
        DB::statement("CREATE OR ALTER VIEW dbo.asesment_pas_v
AS
SELECT        dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, dbo.ri_tc_rawatinap.kode_ri, dbo.ri_tc_rawatinap.tgl_masuk, 
                         dbo.ri_tc_rawatinap.tgl_keluar, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.kode_dokter, 
                         dbo.mt_master_pasien.berat_badan, dbo.mt_master_pasien.jen_kelamin, dbo.ri_tc_rawatinap.diagnosa_awal, dbo.mt_master_pasien.nama_ibu, dbo.ri_tc_rawatinap.dr_merawat, 
                         dbo.mt_master_pasien.tempat_lahir, dbo.mt_master_pasien.nama_kel_ter, dbo.mt_master_pasien.nama_almt_kel, dbo.mt_master_pasien.hubungan_kel, dbo.mt_master_pasien.tlp_kel, 
                         dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_dokter AS dr_periksa, 
                         dbo.mt_master_pasien.jam_lahir, dbo.mt_master_pasien.panjang_badan
FROM            dbo.ri_tc_rawatinap INNER JOIN
                         dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [asesment_pas_v]");
    }
};
