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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_dr_bpjs_v
AS
SELECT     no_registrasi, COUNT(kode_dokter1) AS jumlah_dr
FROM         dbo.dokter_bpjs_v
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_dr_bpjs_v]");
    }
};
