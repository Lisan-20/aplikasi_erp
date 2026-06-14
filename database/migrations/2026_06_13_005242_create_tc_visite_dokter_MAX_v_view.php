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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_visite_dokter_MAX_v
AS
SELECT     MAX(no_urut) AS no_urut, no_registrasi, diagnosa, program, keluhan
FROM         dbo.tc_visite_dokter_detail
GROUP BY no_registrasi, diagnosa, program, keluhan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_visite_dokter_MAX_v]");
    }
};
