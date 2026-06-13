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
        DB::statement("CREATE VIEW dbo.lap_perusahaan_v
AS
SELECT     dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.tc_registrasi.status_batal, 
                      YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, DAY(dbo.tc_registrasi.tgl_jam_masuk) AS tgl
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_perusahaan_v]");
    }
};
