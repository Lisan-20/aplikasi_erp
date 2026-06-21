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
        DB::statement("CREATE OR ALTER VIEW dbo.regis_dobel_v
AS
SELECT     TOP (200) id_tc_registrasi, no_registrasi, no_mr, kode_perusahaan, kode_kelompok, kode_dokter, no_induk, tgl_jam_masuk, tgl_jam_keluar, prioritas, kode_bagian_masuk, kode_bagian_keluar, 
                      status_batal, stat_pasien, status_registrasi, umur_old, tgl_input, id_paket, no_jaminan, nik, kode_pt, nama_pt, status_man, no_jkn, no_skp, plafon_bpjs, diagnosa, kode_plafon, byr_selisih, 
                      flag_daftar, st_daftar_ulang, status_milik, kode_penanggung, umur, id_dc_asal_pasien, flag_dr_fis_perujuk, nama_karyawan, flag_status, noKartuPeserta, tglSep, tglRujukan, noRujukan, 
                      ppkRujukan, ppkPelayanan, jnsPelayanan, catatan, kdDiag, diagAwal, poliTujuan, klsRawat, userInp, noMr, noSep, milike, jnsPeserta, code, id_dc_sub_asal_pasien, ket_batal, flag_p2d, memo, 
                      tgl_update, user_update
FROM         dbo.tc_registrasi
WHERE     (no_mr IN
                          (SELECT     no_mr
                            FROM          dbo.cek_regis_dobel_v)) AND (tgl_jam_keluar IS NULL)
ORDER BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [regis_dobel_v]");
    }
};
