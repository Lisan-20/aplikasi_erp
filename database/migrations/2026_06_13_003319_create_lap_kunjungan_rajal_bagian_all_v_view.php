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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_rajal_bagian_all_v
AS
SELECT     kode_bagian, SUM(jml_pas) AS jmlPas, tgl, bln, thn
FROM         dbo.lap_kunjungan_LP_rajal_v
GROUP BY kode_bagian, tgl, bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_rajal_bagian_all_v]");
    }
};
