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
        DB::statement("CREATE VIEW dbo.pm_pasienpm_bayar_v
AS
SELECT     no_mr, kota, nama_pasien, nama_panggilan, nama_kel_pasien, tgl_lhr, tempat_lahir, almt_ttp_pasien, tlp_almt_ttp, jen_kelamin, suku, nama_kel_ter, nama_almt_kel, hubungan_kel, gol_darah, 
                      status_batal, stat_pasien, no_kunjungan, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, keterangan, kode_penunjang, tgl_daftar, 
                      kode_bagian, no_antrian, tgl_isihasil, no_foto, dr_pengirim, petugas_input, status_daftar, radiografer, petugas_isihasil, catatan_hasil, status_isihasil, no_induk, kode_perusahaan, no_registrasi, 
                      kode_klas, kode_kelompok, no_hasil_pm, status_bayar, YEAR(tgl_daftar) AS tahun, status_man, noSep, st_alergi, st_resum, st_ass_plk_hemo, st_ass_inv_hemo, st_ass_awal_hemo, 
                      st_ass_inv_fisio, st_ass_awal_fisio, ket_pm, kode_dokter
FROM         dbo.pm_pasienpm_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienpm_bayar_v]");
    }
};
