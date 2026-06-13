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
        DB::statement("CREATE VIEW dbo.mt_plafon_bpjs_v
AS
SELECT     dbo.mt_plafon_bpjs.kode_plafon, dbo.mt_plafon_bpjs.nama_plafon, dbo.mt_plafon_bpjs.jumlah_plafon, dbo.mt_plafon_bpjs_detail.jenis_tindakan, 
                      dbo.mt_plafon_bpjs_detail.persen, dbo.mt_plafon_bpjs_detail.kode_bagian
FROM         dbo.mt_plafon_bpjs INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.mt_plafon_bpjs.kode_plafon = dbo.mt_plafon_bpjs_detail.kode_plafon
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_plafon_bpjs_v]");
    }
};
