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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_BpjsNonPbi_rajal_v
AS
SELECT     SUM(jml_pas) AS BpjsNonPbi, validasi_lap_rm, tgl, bln, thn
FROM         dbo.lap_kunjungan_LP_rajal_v
WHERE     (kode_kelompok = '12')
GROUP BY validasi_lap_rm, tgl, bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_BpjsNonPbi_rajal_v]");
    }
};
