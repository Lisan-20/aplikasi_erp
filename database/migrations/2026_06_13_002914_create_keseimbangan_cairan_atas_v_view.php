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
        DB::statement("CREATE OR ALTER VIEW dbo.keseimbangan_cairan_atas_v
AS
SELECT     no_imbang, no_registrasi, tgl_jam, shift, kode_bagian
FROM         dbo.tc_pemeriksaan_cairan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [keseimbangan_cairan_atas_v]");
    }
};
