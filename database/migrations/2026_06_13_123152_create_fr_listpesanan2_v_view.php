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
        DB::statement("CREATE VIEW dbo.fr_listpesanan2_v
AS
SELECT     dbo.fr_tc_pesan_resep.kode_pesan_resep, dbo.fr_tc_pesan_resep.kode_bagian, dbo.fr_tc_pesan_resep.tgl_pesan, 
                      dbo.fr_tc_pesan_resep.status_tebus, dbo.fr_tc_pesan_resep.jumlah_r, dbo.fr_tc_pesan_resep.lokasi_tebus, dbo.fr_tc_pesan_resep.keterangan, 
                      dbo.fr_tc_pesan_resep.no_registrasi, dbo.fr_tc_pesan_resep.kode_perusahaan, dbo.fr_tc_pesan_resep.kode_klas, 
                      dbo.fr_tc_pesan_resep.kode_kelompok, dbo.mt_karyawan.nama_pegawai, dbo.fr_mt_lokasi_tebus.nama_lokasi, dbo.mt_bagian.nama_bagian, 
                      dbo.fr_tc_pesan_resep.kode_dokter, dbo.fr_tc_pesan_resep.kode_bagian_asal, dbo.fr_tc_pesan_resep.no_kunjungan, dbo.mt_master_pasien.no_mr, 
                      dbo.mt_master_pasien.nama_pasien
FROM         dbo.fr_tc_pesan_resep INNER JOIN
                      dbo.fr_mt_lokasi_tebus ON dbo.fr_tc_pesan_resep.lokasi_tebus = dbo.fr_mt_lokasi_tebus.kode_lokasi_tebus INNER JOIN
                      dbo.mt_bagian ON dbo.fr_tc_pesan_resep.kode_bagian_asal = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.fr_tc_pesan_resep.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.fr_tc_pesan_resep.kode_dokter = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_listpesanan2_v]");
    }
};
