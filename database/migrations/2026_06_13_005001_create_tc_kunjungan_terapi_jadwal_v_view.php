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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kunjungan_terapi_jadwal_v
AS
SELECT     dbo.tc_kunjungan_terapi.id_terapi, dbo.tc_kunjungan_terapi.nama_tarif, CONVERT(varchar, dbo.tc_kunjungan_terapi_detail.tgl_jadwal, 105) AS tgl_jadwal, dbo.tc_kunjungan_terapi.no_mr, 
                      dbo.tc_kunjungan_terapi_detail.id_terapi_det, dbo.tc_kunjungan_terapi_detail.tgl_hadir
FROM         dbo.tc_kunjungan_terapi INNER JOIN
                      dbo.tc_kunjungan_terapi_detail ON dbo.tc_kunjungan_terapi.id_terapi = dbo.tc_kunjungan_terapi_detail.id_terapi
WHERE     (dbo.tc_kunjungan_terapi_detail.tgl_hadir IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_terapi_jadwal_v]");
    }
};
