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
        DB::statement("CREATE VIEW dbo.registrasi_simrs_v
AS
SELECT     id_tc_registrasi, no_registrasi, no_mr, kode_perusahaan, kode_kelompok, kode_dokter, no_induk, tgl_jam_masuk, tgl_jam_keluar, prioritas, kode_bagian_masuk, 
                      kode_bagian_keluar, status_batal, stat_pasien, status_registrasi, umur_old, tgl_input, id_paket, no_jaminan, nik, kode_pt, nama_pt, status_man, no_jkn, no_skp, 
                      plafon_bpjs, diagnosa, kode_plafon, byr_selisih, flag_daftar, st_daftar_ulang, status_milik, kode_penanggung, umur, id_dc_asal_pasien, flag_dr_fis_perujuk, 
                      nama_karyawan, flag_status, noKartuPeserta, tglSep, tglRujukan, noRujukan, ppkRujukan, ppkPelayanan, jnsPelayanan, catatan, kdDiag, diagAwal, poliTujuan, 
                      klsRawat, userInp, noMr, noSep, milike, jnsPeserta, code, id_dc_sub_asal_pasien, ket_batal, flag_p2d, memo, tgl_update, user_update, flag_pending, 
                      flag_pending_bpjs, CONVERT(VARCHAR(10), tgl_jam_masuk, 120) AS TglMasuk, CONVERT(VARCHAR(10), tgl_jam_keluar, 120) AS TglKeluar, MONTH(tgl_jam_masuk) 
                      AS bln
FROM         dbo.tc_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [registrasi_simrs_v]");
    }
};
