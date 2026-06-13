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
        DB::statement("CREATE OR ALTER VIEW dbo.cart_nasabah_bpjs_v
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jml, dbo.tc_registrasi.kode_kelompok, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, dbo.mt_nasabah.nama_kelompok
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok
GROUP BY MONTH(dbo.tc_registrasi.tgl_jam_masuk), YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.status_batal, dbo.tc_registrasi.kode_kelompok, 
                      dbo.mt_nasabah.nama_kelompok
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (YEAR(dbo.tc_registrasi.tgl_jam_masuk) >= 2016) AND (dbo.tc_registrasi.kode_kelompok IN (9, 8, 11))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cart_nasabah_bpjs_v]");
    }
};
