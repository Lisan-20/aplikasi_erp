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
        DB::statement("CREATE VIEW dbo.tc_dpjp_rinap_grup_v
AS
SELECT     nama_dokter_merawat, dr_merawat, no_registrasi, no_mr
FROM         dbo.tc_dpjp_rinap_v
GROUP BY nama_dokter_merawat, dr_merawat, no_registrasi, no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_dpjp_rinap_grup_v]");
    }
};
