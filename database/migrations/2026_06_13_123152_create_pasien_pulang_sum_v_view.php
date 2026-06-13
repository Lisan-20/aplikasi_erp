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
        DB::statement("CREATE VIEW dbo.pasien_pulang_sum_v
AS
SELECT     COUNT(dbo.ri_cari_pasien_history_v.no_registrasi) AS jml_pasien, dbo.ri_cari_pasien_history_v.bag_pas, DAY(dbo.ri_cari_pasien_history_v.tgl_keluar) AS tgl, 
                      MONTH(dbo.ri_cari_pasien_history_v.tgl_keluar) AS bln, YEAR(dbo.ri_cari_pasien_history_v.tgl_keluar) AS thn, dbo.tc_kunjungan.status_keluar, 
                      dbo.ri_cari_pasien_history_v.kelas_pas
FROM         dbo.ri_cari_pasien_history_v INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_cari_pasien_history_v.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
GROUP BY dbo.ri_cari_pasien_history_v.bag_pas, DAY(dbo.ri_cari_pasien_history_v.tgl_keluar), MONTH(dbo.ri_cari_pasien_history_v.tgl_keluar), 
                      YEAR(dbo.ri_cari_pasien_history_v.tgl_keluar), dbo.tc_kunjungan.status_keluar, dbo.ri_cari_pasien_history_v.kelas_pas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_pulang_sum_v]");
    }
};
