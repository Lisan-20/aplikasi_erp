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
        DB::statement("CREATE VIEW dbo.plafon_bpjs_v
AS
SELECT     dbo.mt_plafon_bpjs_detail.kode_plafon_det, dbo.mt_plafon_bpjs_detail.kode_plafon, dbo.mt_plafon_bpjs_detail.jenis_tindakan, dbo.mt_plafon_bpjs_detail.persen, 
                      dbo.mt_plafon_bpjs_detail.bill_rs_jatah, dbo.mt_plafon_bpjs_detail.bill_dr1_jatah, dbo.mt_plafon_bpjs_detail.keterangan, dbo.mt_bagian.kode_bagian
FROM         dbo.mt_plafon_bpjs_detail INNER JOIN
                      dbo.mt_bagian ON dbo.mt_plafon_bpjs_detail.kode_bagian = dbo.mt_bagian.val_bpjs
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [plafon_bpjs_v]");
    }
};
