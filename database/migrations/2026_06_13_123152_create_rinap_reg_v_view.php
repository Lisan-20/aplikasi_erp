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
        DB::statement("CREATE OR ALTER VIEW dbo.rinap_reg_v
AS
SELECT     CONVERT(VARCHAR(10), tgl_jam_masuk, 110) AS tgl_masuk, CONVERT(VARCHAR(10), tgl_jam_keluar, 110) AS tgl_keluar, no_mr, noSep, no_registrasi
FROM         dbo.tc_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rinap_reg_v]");
    }
};
