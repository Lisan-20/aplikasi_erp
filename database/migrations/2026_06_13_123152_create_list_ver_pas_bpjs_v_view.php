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
        DB::statement("CREATE OR ALTER VIEW dbo.list_ver_pas_bpjs_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, 
                      MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, dbo.tc_registrasi.kode_dokter, dbo.mt_plafon_bpjs_rawat_jalan.plafon, 
                      dbo.mt_plafon_bpjs_rawat_jalan.plafon - dbo.tc_trans_kasir.nk_perusahaan AS selisih, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.st_daftar_ulang
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr CROSS JOIN
                      dbo.mt_plafon_bpjs_rawat_jalan
WHERE     (dbo.tc_registrasi.kode_kelompok = 9) AND (NOT (dbo.tc_trans_kasir.kode_bagian LIKE '03%')) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_kasir.nk_perusahaan > 0) AND (dbo.mt_plafon_bpjs_rawat_jalan.plafon - dbo.tc_trans_kasir.nk_perusahaan < 0) AND 
                      (NOT (dbo.tc_registrasi.kode_bagian_keluar LIKE '03%')) AND (dbo.tc_registrasi.kode_bagian_keluar IS NOT NULL) AND (dbo.tc_registrasi.st_daftar_ulang = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_ver_pas_bpjs_v]");
    }
};
