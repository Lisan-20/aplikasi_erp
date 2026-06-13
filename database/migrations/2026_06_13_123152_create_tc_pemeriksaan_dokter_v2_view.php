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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_dokter_v2
AS
SELECT     dbo.tc_pemeriksaan_erm.kode_tc_periksa, dbo.tc_pemeriksaan_erm.id_mt_kd, dbo.tc_pemeriksaan_erm.kode_bagian, dbo.tc_pemeriksaan_erm.no_kunjungan, 
                      dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.tc_pemeriksaan_erm.kd_lev, dbo.tc_pemeriksaan_erm.kd_type, dbo.tc_pemeriksaan_erm.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, 
                      dbo.tc_pemeriksaan_erm.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_pemeriksaan_erm.ket AS ket_hasil, dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, 
                      dbo.mt_acc_erm.nama_pemeriksaan
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_erm.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_erm.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_pemeriksaan_erm.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_dokter_v2]");
    }
};
