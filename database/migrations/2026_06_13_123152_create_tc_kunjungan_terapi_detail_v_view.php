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
        DB::statement("CREATE VIEW dbo.tc_kunjungan_terapi_detail_v
AS
SELECT     dbo.tc_kunjungan_terapi_detail.no_mr, dbo.tc_kunjungan_terapi_detail.no_registrasi, dbo.tc_kunjungan_terapi.kode_tarif, dbo.tc_kunjungan_terapi.nama_tarif, 
                      dbo.tc_kunjungan_terapi_detail.no_urut, dbo.tc_kunjungan_terapi_detail.tgl_update, dbo.tc_kunjungan_terapi_detail.tgl_hadir, dbo.tc_kunjungan_terapi_detail.id_terapi_det, 
                      dbo.tc_kunjungan_terapi_detail.no_kunjungan, dbo.tc_kunjungan_terapi_detail.user_id, dbo.tc_kunjungan_terapi_detail.ttd, dbo.tc_kunjungan_terapi_detail.id_terapi, 
                      dbo.tc_kunjungan_terapi_detail.tgl_jadwal, dbo.tc_kunjungan_terapi_detail.tgl_update_jadwal, dbo.tc_kunjungan_terapi_detail.catatan, YEAR(dbo.tc_kunjungan_terapi_detail.tgl_hadir) AS thn, 
                      MONTH(dbo.tc_kunjungan_terapi_detail.tgl_hadir) AS bln, DAY(dbo.tc_kunjungan_terapi_detail.tgl_hadir) AS tgl, dbo.tc_kunjungan_terapi_detail.kode_dokter
FROM         dbo.tc_kunjungan_terapi INNER JOIN
                      dbo.tc_kunjungan_terapi_detail ON dbo.tc_kunjungan_terapi.id_terapi = dbo.tc_kunjungan_terapi_detail.id_terapi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_terapi_detail_v]");
    }
};
