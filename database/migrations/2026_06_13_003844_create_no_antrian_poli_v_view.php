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
        DB::statement("
CREATE OR ALTER VIEW [dbo].[no_antrian_poli_v]
AS
SELECT        dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.kode_bagian, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS Expr1, dbo.tc_registrasi.flag_kirim, 
                         dbo.tc_registrasi.respon_addantrian
FROM            dbo.tc_kunjungan INNER JOIN
                         dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE        (YEAR(dbo.tc_registrasi.tgl_jam_masuk) > 2021)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [no_antrian_poli_v]");
    }
};
