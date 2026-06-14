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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_new_tindakan_v
AS
SELECT     kode_tarif, nama_tindakan, no_kunjungan, no_registrasi, no_mr, jumlah, kode_bagian, kode_penunjang, kode_kelompok, status_selesai, tgl,bln,thn
FROM         pm_pemeriksaanpasienluar_v
WHERE     status_selesai >= 2 AND no_kunjungan NOT IN
                          (SELECT     no_kunjungan
                            FROM          tc_kunjungan
                            WHERE      status_batal = 1)
UNION
SELECT     kode_tarif, nama_tindakan, no_kunjungan, no_registrasi, no_mr, jumlah, kode_bagian, kode_penunjang, kode_kelompok, status_selesai, tgl,bln,thn
FROM         pm_pemeriksaanpasien_v
WHERE     status_selesai >= 2 AND no_kunjungan NOT IN
                          (SELECT     no_kunjungan
                            FROM          tc_kunjungan
                            WHERE      status_batal = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_new_tindakan_v]");
    }
};
