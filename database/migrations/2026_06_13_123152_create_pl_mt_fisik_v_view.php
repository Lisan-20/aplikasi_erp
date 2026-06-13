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
        DB::statement("CREATE VIEW dbo.pl_mt_fisik_v
AS
SELECT     TOP (100) PERCENT dbo.mt_fisik.kode_pemeriksaan, dbo.mt_fisik.nama_pemeriksaan, dbo.mt_fisik.referensi, dbo.mt_fisik.kode_bagian, 
                      dbo.mt_fisik.kode_grup_tindakan, dbo.mt_fisik.id_mt_fisik, dbo.pl_mt_pasien_v.kode_poli, dbo.pl_mt_pasien_v.no_kunjungan, dbo.pl_mt_pasien_v.no_antrian, 
                      dbo.pl_mt_pasien_v.tgl_jam_poli, dbo.pl_mt_pasien_v.kode_dokter, dbo.pl_mt_pasien_v.no_mr, dbo.pl_mt_pasien_v.nama_pasien, dbo.pl_mt_pasien_v.tgl_lhr, 
                      dbo.pl_mt_pasien_v.no_registrasi, dbo.pl_mt_pasien_v.jen_kelamin, dbo.pl_mt_pasien_v.gol_darah, dbo.pl_mt_pasien_v.alamat_pasien, 
                      dbo.mt_master_pasien.kd_bgn
FROM         dbo.pl_mt_pasien_v INNER JOIN
                      dbo.mt_fisik ON dbo.pl_mt_pasien_v.kode_bagian = dbo.mt_fisik.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON dbo.pl_mt_pasien_v.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_fisik_v]");
    }
};
