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
        DB::statement("CREATE VIEW dbo.master_plafon_bpjs_v
AS
SELECT     dbo.mt_plafon_bpjs.nama_plafon, dbo.mt_plafon_bpjs_detail.jenis_tindakan, dbo.mt_plafon_bpjs_detail.keterangan, dbo.mt_plafon_bpjs_detail.persen, 
                      dbo.mt_plafon_bpjs_detail.persen_dr, dbo.mt_plafon_bpjs.kode_plafon
FROM         dbo.mt_plafon_bpjs INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.mt_plafon_bpjs.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [master_plafon_bpjs_v]");
    }
};
