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
        DB::statement("CREATE VIEW dbo.pasien_masih_rawat_obat2_v
AS
SELECT     TOP (100) PERCENT dbo.fr_far_resep_ri_dokter.kode_brg, SUM(dbo.fr_far_resep_ri_dokter.jumlah) AS jumlah, dbo.pasien_masih_rawat_obat_v.kode_depo_bag AS bag_pas, 
                      dbo.fr_far_resep_ri_dokter.flag_perawat, dbo.fr_far_resep_ri_dokter.flag_permintaan, dbo.fr_far_resep_ri_dokter.flag_1x
FROM         dbo.fr_far_resep_ri_dokter INNER JOIN
                      dbo.pasien_masih_rawat_obat_v ON dbo.fr_far_resep_ri_dokter.no_registrasi = dbo.pasien_masih_rawat_obat_v.no_registrasi
GROUP BY dbo.fr_far_resep_ri_dokter.kode_brg, dbo.fr_far_resep_ri_dokter.st_stop, dbo.pasien_masih_rawat_obat_v.kode_depo_bag, dbo.fr_far_resep_ri_dokter.flag_perawat, 
                      dbo.fr_far_resep_ri_dokter.flag_permintaan, dbo.fr_far_resep_ri_dokter.flag_1x
HAVING      (dbo.fr_far_resep_ri_dokter.st_stop IS NULL) AND (dbo.fr_far_resep_ri_dokter.flag_perawat IS NULL) AND (dbo.fr_far_resep_ri_dokter.flag_permintaan IN (1, 3))
ORDER BY dbo.fr_far_resep_ri_dokter.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_masih_rawat_obat2_v]");
    }
};
