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
        DB::statement("CREATE VIEW dbo.history_pasien_jkn_rajal_v
AS
SELECT     TOP (100) PERCENT b.nama_pasien, c.nama_bagian, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan AS Expr2, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.no_jkn, dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, 
                      dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_trans_kasir.nk_perusahaan, b.no_mr, dbo.tc_registrasi.no_registrasi, 
                      dbo.tc_registrasi.noSep, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.status_batal, dbo.tc_registrasi.status_batal AS Expr3, dbo.tc_sep_ri_temp.total_tarif, dbo.tc_sep_ri_temp.tarif_rs, 
                      dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_bagian AS c ON dbo.tc_registrasi.kode_bagian_masuk = c.kode_bagian INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.mt_master_pasien AS b ON dbo.tc_registrasi.no_mr = b.no_mr LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter LEFT OUTER JOIN
                      dbo.tc_sep_ri_temp ON b.no_mr = dbo.tc_sep_ri_temp.no_mr AND dbo.tc_registrasi.noSep = dbo.tc_sep_ri_temp.no_sep
WHERE     (dbo.tc_registrasi.kode_kelompok IN (8, 9, 10, 11, 12)) AND (dbo.tc_registrasi.tgl_jam_keluar IS NOT NULL) AND (NOT (dbo.tc_registrasi.kode_bagian_masuk LIKE '03%')) AND 
                      (NOT (dbo.tc_registrasi.kode_bagian_keluar LIKE '03%')) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [history_pasien_jkn_rajal_v]");
    }
};
