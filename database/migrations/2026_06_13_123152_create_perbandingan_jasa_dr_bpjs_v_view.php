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
        DB::statement("CREATE VIEW dbo.perbandingan_jasa_dr_bpjs_v
AS
SELECT     id_jenis_layanan, billing AS billing_dr, plafon AS plafon_dr, no_registrasi
FROM         dbo.tc_trans_jkn
WHERE     (id_jenis_layanan = 6)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [perbandingan_jasa_dr_bpjs_v]");
    }
};
