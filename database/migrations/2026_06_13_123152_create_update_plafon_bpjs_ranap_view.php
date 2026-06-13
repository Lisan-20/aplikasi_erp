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
        DB::statement("CREATE VIEW dbo.update_plafon_bpjs_ranap
AS
SELECT     dbo.mt_plafon_bpjs_detail.persen, mt_plafon_bpjs_detail_1.persen AS persen1, dbo.mt_plafon_bpjs_detail.persen_dr, 
                      mt_plafon_bpjs_detail_1.persen_dr AS persen_dr1
FROM         dbo.mt_plafon_bpjs_detail INNER JOIN
                      medi2cbr_bak.dbo.mt_plafon_bpjs_detail AS mt_plafon_bpjs_detail_1 ON 
                      dbo.mt_plafon_bpjs_detail.id_jenis_layanan = mt_plafon_bpjs_detail_1.id_jenis_layanan AND 
                      dbo.mt_plafon_bpjs_detail.keterangan = mt_plafon_bpjs_detail_1.keterangan AND 
                      dbo.mt_plafon_bpjs_detail.kode_plafon_det = mt_plafon_bpjs_detail_1.kode_plafon_det AND 
                      dbo.mt_plafon_bpjs_detail.kode_plafon = mt_plafon_bpjs_detail_1.kode_plafon
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_plafon_bpjs_ranap]");
    }
};
