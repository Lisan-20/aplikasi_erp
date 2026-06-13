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
        DB::statement("CREATE VIEW dbo.batal_tc_kunjungan_v
AS
SELECT     dbo.tc_kunjungan.id_tc_kunjungan, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_dokter, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_masuk, 
                      dbo.tc_kunjungan.status_keluar, dbo.tc_kunjungan.status_cito, dbo.tc_kunjungan.keterangan, dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.flag_um, dbo.tc_kunjungan.kode_tc_trans_kasir, 
                      dbo.tc_kunjungan.tgl_blpl, dbo.tc_kunjungan.tgl_pulang, dbo.tc_kunjungan.flag_icd, dbo.tc_kunjungan.user_pulang, dbo.tc_kunjungan.status_blpl, dbo.tc_kunjungan.flag_fisio, 
                      dbo.tc_kunjungan.user_batal, dbo.tc_kunjungan.kode_bagian_batal, dbo.tc_kunjungan.flag_titipan, dbo.tc_kunjungan.status_triase, dbo.tc_kunjungan.tgl_kontrol, dbo.tc_kunjungan.flag_wa, 
                      dbo.tc_kunjungan.flag_serah, dbo.tc_kunjungan.tgl_serah, dbo.tc_kunjungan.no_induk, dbo.tc_kunjungan.ttd_resum, dbo.tc_kunjungan.tgl_jam_ttd, dbo.tc_kunjungan.nama_wali_resum, 
                      dbo.tc_kunjungan_batal.id_tc_kunjungan AS Expr1
FROM         dbo.tc_kunjungan LEFT OUTER JOIN
                      dbo.tc_kunjungan_batal ON dbo.tc_kunjungan.id_tc_kunjungan = dbo.tc_kunjungan_batal.id_tc_kunjungan
WHERE     (dbo.tc_kunjungan.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_registrasi_batal)) AND (dbo.tc_kunjungan_batal.id_tc_kunjungan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_tc_kunjungan_v]");
    }
};
