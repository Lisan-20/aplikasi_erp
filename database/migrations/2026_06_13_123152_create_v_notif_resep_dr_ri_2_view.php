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
        DB::statement("CREATE VIEW dbo.v_notif_resep_dr_ri_2
AS
SELECT     TOP (100) PERCENT a.no_mr, a.nama_pasien, b.no_kunjungan, b.no_registrasi, b.kode_resep, b.kode_dokter, b.flag_kirim
FROM         dbo.mt_master_pasien AS a INNER JOIN
                      dbo.fr_far_resep_ri_dokter_apo_v AS b ON a.no_mr = b.no_mr
WHERE     (b.flag_kirim = 1)
GROUP BY a.no_mr, a.nama_pasien, b.no_kunjungan, b.no_registrasi, b.kode_resep, b.kode_dokter, b.flag_kirim
ORDER BY b.kode_resep DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_notif_resep_dr_ri_2]");
    }
};
