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
        DB::statement("CREATE OR ALTER VIEW dbo.register_poli_v
AS
SELECT     dbo.pl_tc_poli.tgl_jam_poli, dbo.pl_tc_poli.kode_bagian, dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.noSep, dbo.pl_tc_poli.kode_dokter, dbo.tc_registrasi.no_registrasi, 
                      dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.pl_tc_poli ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [register_poli_v]");
    }
};
