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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_registrasi_massal_v
AS
SELECT     dbo.tc_registrasi.id_tc_registrasi, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, 
                      dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur, dbo.tc_pendaftaran_masal.penyelenggara, dbo.tc_pendaftaran_masal.alamat, 
                      dbo.tc_pendaftaran_masal.no_telp, dbo.tc_pendaftaran_masal.status, dbo.tc_pendaftaran_masal.jumlah, dbo.tc_pendaftaran_masal.kode_tarif, 
                      dbo.tc_pendaftaran_masal.inp_id, dbo.tc_pendaftaran_masal.id_masal, dbo.mt_master_pasien.nama_pasien
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_pendaftaran_masal ON dbo.tc_registrasi.id_paket = dbo.tc_pendaftaran_masal.id_masal INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_registrasi_massal_v]");
    }
};
