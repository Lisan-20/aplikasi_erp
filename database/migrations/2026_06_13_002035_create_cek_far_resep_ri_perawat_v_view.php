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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_far_resep_ri_perawat_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.id_resep_ri_dr, dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far_detail.kd_tr_resep, 
                      dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.status_transaksi, dbo.fr_far_resep_ri_dokter.flag_permintaan, dbo.fr_far_resep_ri_dokter.kode_rm, 
                      dbo.fr_far_resep_ri_dokter.flag_perawat
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.fr_far_resep_ri_dokter ON dbo.fr_tc_far_detail.id_resep_ri_dr = dbo.fr_far_resep_ri_dokter.id_resep_ri_dr
WHERE     (dbo.fr_tc_far.status_transaksi = 1) AND (dbo.fr_far_resep_ri_dokter.flag_perawat = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_far_resep_ri_perawat_v]");
    }
};
