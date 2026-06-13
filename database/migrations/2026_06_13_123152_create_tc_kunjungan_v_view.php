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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kunjungan_v
AS
SELECT     dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.umur, dbo.tc_kunjungan.kode_dokter, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_batal
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi
WHERE     (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_v]");
    }
};
