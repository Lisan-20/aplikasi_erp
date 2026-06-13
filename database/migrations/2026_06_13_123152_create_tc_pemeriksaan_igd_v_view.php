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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_igd_v
AS
SELECT     dbo.tc_pemeriksaan_igd.id_mt_kd, dbo.tc_pemeriksaan_igd.kode_bagian, dbo.tc_pemeriksaan_igd.no_kunjungan, dbo.tc_pemeriksaan_igd.kd_lev, dbo.tc_pemeriksaan_igd.kd_type, 
                      dbo.tc_pemeriksaan_igd.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_igd.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_igd.ket AS ket_hasil, dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_igd.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_igd.id_triase, dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna
FROM         dbo.tc_pemeriksaan_igd INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_igd.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_igd.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
WHERE     (dbo.tc_pemeriksaan_igd.kd_lev = 3) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_igd_v]");
    }
};
