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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kode_plafon
AS
SELECT     dbo.tc_registrasi.kode_plafon, dbo.tc_trans_jkn.kode_plafon AS kode_plafon_asli
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_jkn.no_registrasi
WHERE     (dbo.tc_registrasi.kode_plafon IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_plafon]");
    }
};
