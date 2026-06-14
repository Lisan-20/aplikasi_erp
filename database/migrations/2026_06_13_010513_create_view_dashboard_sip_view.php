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
        DB::statement("CREATE OR ALTER VIEW dbo.view_dashboard_sip
AS
SELECT     kelas_dan_ruang, logo, jml_bed, jml_isi, jml_bed - jml_isi AS sisa, kode_bpjs, jml_bed_asli, no
FROM         dbo.view_dashboard_fiks
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard_sip]");
    }
};
