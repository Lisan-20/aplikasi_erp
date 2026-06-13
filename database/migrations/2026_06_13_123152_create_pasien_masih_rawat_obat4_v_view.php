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
        DB::statement("CREATE VIEW dbo.pasien_masih_rawat_obat4_v
AS
SELECT     dbo.fr_far_resep_ri_display.id, dbo.fr_far_resep_ri_display.kode_brg, dbo.pasien_masih_rawat_obat2_v.jumlah, dbo.pasien_masih_rawat_obat2_v.bag_pas, 
                      dbo.fr_far_resep_ri_display.jml_bag1
FROM         dbo.fr_far_resep_ri_display INNER JOIN
                      dbo.pasien_masih_rawat_obat2_v ON dbo.fr_far_resep_ri_display.kode_brg = dbo.pasien_masih_rawat_obat2_v.kode_brg
WHERE     (dbo.pasien_masih_rawat_obat2_v.bag_pas = '500004')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_masih_rawat_obat4_v]");
    }
};
