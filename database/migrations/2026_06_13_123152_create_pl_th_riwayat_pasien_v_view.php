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
        DB::statement("CREATE OR ALTER VIEW dbo.pl_th_riwayat_pasien_v
AS
SELECT     dbo.pl_tc_poli.id_pl_tc_poli, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.th_riwayat_pasien.tgl_periksa, 
                      dbo.th_riwayat_pasien.kode_bagian, dbo.pl_tc_poli.status_periksa, dbo.th_riwayat_pasien.kode_riwayat, dbo.th_riwayat_pasien.no_mr, 
                      dbo.th_riwayat_pasien.nama_pasien, dbo.th_riwayat_pasien.diagnosa_awal, dbo.th_riwayat_pasien.anamnesa, dbo.th_riwayat_pasien.pengobatan, 
                      dbo.th_riwayat_pasien.dokter_pemeriksa, dbo.th_riwayat_pasien.pemeriksaan, dbo.th_riwayat_pasien.diagnosa_akhir
FROM         dbo.th_riwayat_pasien INNER JOIN
                      dbo.pl_tc_poli ON dbo.th_riwayat_pasien.no_kunjungan = dbo.pl_tc_poli.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_th_riwayat_pasien_v]");
    }
};
