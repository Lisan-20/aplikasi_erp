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
        DB::statement("CREATE VIEW dbo.rekap_poli_sum_v
AS
SELECT        MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, COUNT(dbo.tc_registrasi.kode_kelompok) AS jml, 
                         dbo.tc_registrasi.kode_kelompok, dbo.mt_nasabah.nama_kelompok
FROM            dbo.mt_bagian INNER JOIN
                         dbo.tc_registrasi ON dbo.mt_bagian.kode_bagian = dbo.tc_registrasi.kode_bagian_masuk INNER JOIN
                         dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok
WHERE        (dbo.mt_bagian.kode_bagian LIKE '01%')
GROUP BY MONTH(dbo.tc_registrasi.tgl_jam_masuk), YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.kode_kelompok, dbo.mt_nasabah.nama_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_poli_sum_v]");
    }
};
