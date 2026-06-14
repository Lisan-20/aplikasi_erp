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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kunjungan_terapi_v
AS
SELECT     nama_tarif, tgl_awal, id_terapi, no_mr, no_registrasi
FROM         dbo.tc_kunjungan_terapi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_terapi_v]");
    }
};
