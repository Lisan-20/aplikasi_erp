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
        DB::statement("CREATE VIEW dbo.fr_far_resep_ri_etiket_v
AS
SELECT     dbo.fr_far_resep_ri_dokter.jam1, dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.no_mr, 
                      dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.nama_pasien, dbo.fr_far_resep_ri_dokter.no_registrasi AS Expr1
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.fr_far_resep_ri_dokter ON dbo.fr_tc_far.no_registrasi = dbo.fr_far_resep_ri_dokter.no_registrasi AND dbo.fr_tc_far_detail.kode_brg = dbo.fr_far_resep_ri_dokter.kode_brg
GROUP BY dbo.fr_far_resep_ri_dokter.jam1, dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.no_mr, 
                      dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.nama_pasien, dbo.fr_far_resep_ri_dokter.no_registrasi
HAVING      (dbo.fr_tc_far.no_mr = '040704')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_etiket_v]");
    }
};
