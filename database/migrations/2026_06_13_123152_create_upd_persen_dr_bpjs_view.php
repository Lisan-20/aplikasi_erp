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
        DB::statement("CREATE VIEW dbo.upd_persen_dr_bpjs
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_jkn.persen_dr, dbo.mt_plafon_bpjs_detail.persen_dr AS persen_dr_mt, dbo.tc_trans_jkn.no_registrasi, 
                      dbo.tc_trans_jkn.id_jenis_layanan
FROM         dbo.tc_trans_jkn INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.tc_trans_jkn.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon AND 
                      dbo.tc_trans_jkn.id_jenis_layanan = dbo.mt_plafon_bpjs_detail.id_jenis_layanan
ORDER BY dbo.tc_trans_jkn.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_persen_dr_bpjs]");
    }
};
