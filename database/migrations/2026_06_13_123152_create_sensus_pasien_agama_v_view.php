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
        DB::statement("CREATE VIEW dbo.sensus_pasien_agama_v
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jumlah, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, dbo.mt_master_pasien.kode_agama, 
                      dbo.dc_agama.agama
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.dc_agama ON dbo.mt_master_pasien.kode_agama = dbo.dc_agama.id_dc_agama
WHERE     (NOT (dbo.tc_registrasi.tgl_jam_keluar IS NULL))
GROUP BY MONTH(dbo.tc_registrasi.tgl_jam_masuk), YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_registrasi.status_batal, dbo.mt_master_pasien.kode_agama, dbo.dc_agama.agama
HAVING      (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_pasien_agama_v]");
    }
};
