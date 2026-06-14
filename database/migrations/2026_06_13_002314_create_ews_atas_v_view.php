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
        DB::statement("CREATE OR ALTER VIEW dbo.ews_atas_v
AS
SELECT     tgl_jam, no_registrasi, no_urut_ews, jenis
FROM         dbo.tc_pemeriksaan_ews
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ews_atas_v]");
    }
};
