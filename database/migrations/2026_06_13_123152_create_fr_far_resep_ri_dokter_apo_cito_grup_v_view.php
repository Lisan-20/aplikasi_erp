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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_far_resep_ri_dokter_apo_cito_grup_v
AS
SELECT     kode_resep, no_registrasi, no_mr, kode_dokter, flag_kirim, flag_perawat, flag_permintaan, flag_1x
FROM         dbo.fr_far_resep_ri_dokter_apo_cito_v
GROUP BY kode_resep, no_registrasi, no_mr, kode_dokter, flag_kirim, flag_perawat, flag_permintaan, flag_1x
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_dokter_apo_cito_grup_v]");
    }
};
