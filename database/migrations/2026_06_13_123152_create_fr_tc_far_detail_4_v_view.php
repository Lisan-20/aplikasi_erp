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
        DB::statement("CREATE VIEW dbo.fr_tc_far_detail_4_v
AS
SELECT     dbo.fr_tc_far_detail.id_resep_ri_dr, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.fr_tc_far_detail.jam4 AS jam, 
                      dbo.fr_tc_far_detail.tgl_update4 AS tgl, dbo.fr_tc_far_detail.id_user4 AS id_user, 4 AS waktu
FROM         dbo.fr_tc_far_detail INNER JOIN
                      dbo.fr_tc_far ON dbo.fr_tc_far_detail.kode_trans_far = dbo.fr_tc_far.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.fr_tc_far_detail.id_resep_ri_dr IS NOT NULL) AND (dbo.fr_tc_far_detail.jam4 IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_far_detail_4_v]");
    }
};
