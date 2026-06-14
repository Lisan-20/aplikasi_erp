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
        DB::statement("CREATE OR ALTER VIEW dbo.notif_perawat_cito_v
AS
SELECT     TOP (100) PERCENT b.flag_1x, a.no_mr, a.nama_pasien, b.no_registrasi, b.kode_resep, b.flag_kirim, b.kode_rm, b.bag_pas, b.kode_ruangan, b.kelas_pas, b.nama_bagian, b.flag_perawat
FROM         dbo.mt_master_pasien AS a INNER JOIN
                      dbo.fr_far_resep_ri_dokter_apo_cito_v AS b ON a.no_mr = b.no_mr
WHERE     (b.flag_1x IS NULL) AND (b.flag_permintaan IN (2, 3)) AND (b.flag_kirim = 1) AND (b.flag_perawat = 1)
GROUP BY b.flag_1x, a.no_mr, a.nama_pasien, b.no_registrasi, b.kode_resep, b.flag_kirim, b.kode_rm, b.bag_pas, b.kode_ruangan, b.kelas_pas, b.nama_bagian, b.flag_perawat
ORDER BY b.kode_resep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [notif_perawat_cito_v]");
    }
};
