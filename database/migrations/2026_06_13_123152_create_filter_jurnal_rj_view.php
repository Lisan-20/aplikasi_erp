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
        DB::statement("CREATE VIEW dbo.filter_jurnal_rj
AS
SELECT     dbo.filter_jurnal_rj_D.D, dbo.filter_jurnal_rj_D.seri_kuitansi, dbo.filter_jurnal_rj_D.no_kuitansi, dbo.filter_jurnal_rj_K_diskon.K, dbo.filter_jurnal_rj_K_diskon.kode_tc_trans_kasir
FROM         dbo.filter_jurnal_rj_D INNER JOIN
                      dbo.filter_jurnal_rj_K_diskon ON dbo.filter_jurnal_rj_D.D = dbo.filter_jurnal_rj_K_diskon.K AND dbo.filter_jurnal_rj_D.kode_tc_trans_kasir = dbo.filter_jurnal_rj_K_diskon.kode_tc_trans_kasir AND 
                      dbo.filter_jurnal_rj_D.no_kuitansi = dbo.filter_jurnal_rj_K_diskon.no_kuitansi AND dbo.filter_jurnal_rj_D.seri_kuitansi = dbo.filter_jurnal_rj_K_diskon.seri_kuitansi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_rj]");
    }
};
