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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_visit_dr_v
AS
SELECT     TOP (100) PERCENT dbo.pasien_masuk_malam_v.no_registrasi, dbo.fee_dokter_rinap_temp.tgl_transaksi, dbo.fee_dokter_rinap_temp.nama_tindakan, 
                      dbo.fee_dokter_rinap_temp.jumlah, dbo.pasien_masuk_malam_v.tgl_masuk, dbo.mt_karyawan.nama_pegawai, dbo.fee_dokter_rinap_temp.kode_kelompok, 
                      dbo.mt_karyawan.kode_dokter
FROM         dbo.fee_dokter_rinap_temp INNER JOIN
                      dbo.pasien_masuk_malam_v ON dbo.fee_dokter_rinap_temp.no_registrasi = dbo.pasien_masuk_malam_v.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.fee_dokter_rinap_temp.kode_dr = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.fee_dokter_rinap_temp.nama_tindakan = 'Visite dr. Umum')
ORDER BY dbo.pasien_masuk_malam_v.no_registrasi, dbo.fee_dokter_rinap_temp.tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_visit_dr_v]");
    }
};
