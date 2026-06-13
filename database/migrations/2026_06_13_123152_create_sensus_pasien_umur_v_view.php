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
        DB::statement("CREATE VIEW dbo.sensus_pasien_umur_v
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jumlah, DAY(dbo.tc_registrasi.tgl_jam_masuk) AS tgl, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, 
                      YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, dbo.tc_registrasi.umur, dbo.mt_master_pasien.tgl_lhr, dbo.tc_registrasi.tgl_jam_masuk, DATEDIFF(day, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.tc_registrasi.tgl_jam_masuk) AS selisih
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian
WHERE     (NOT (dbo.tc_registrasi.tgl_jam_keluar IS NULL))
GROUP BY DAY(dbo.tc_registrasi.tgl_jam_masuk), MONTH(dbo.tc_registrasi.tgl_jam_masuk), YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.status_batal, 
                      dbo.tc_registrasi.umur, dbo.mt_master_pasien.tgl_lhr, dbo.tc_registrasi.tgl_jam_masuk
HAVING      (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_pasien_umur_v]");
    }
};
