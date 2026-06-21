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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_persen_dr
AS
SELECT     dbo.tc_trans_jkn.persen_dr, dbo.mt_plafon_bpjs_detail.persen_dr AS persen, dbo.tc_trans_jkn.id_jenis_layanan
FROM         dbo.tc_trans_jkn INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.tc_trans_jkn.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon AND 
                      dbo.tc_trans_jkn.id_jenis_layanan = dbo.mt_plafon_bpjs_detail.id_jenis_layanan
WHERE     (dbo.tc_trans_jkn.persen_dr IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_persen_dr]");
    }
};
