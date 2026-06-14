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
        DB::statement("CREATE OR ALTER VIEW dbo.api_penunjang_medis_v
AS
SELECT        MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, COUNT(dbo.tc_registrasi.kode_kelompok) AS jml, 
                         dbo.tc_registrasi.kode_kelompok, dbo.mt_nasabah.nama_kelompok
FROM            dbo.mt_nasabah INNER JOIN
                         dbo.tc_registrasi ON dbo.mt_nasabah.kode_kelompok = dbo.tc_registrasi.kode_kelompok INNER JOIN
                         dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian
WHERE        (dbo.mt_bagian.kode_bagian LIKE '05%')
GROUP BY MONTH(dbo.tc_registrasi.tgl_jam_masuk), YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.kode_kelompok, dbo.mt_nasabah.nama_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [api_penunjang_medis_v]");
    }
};
