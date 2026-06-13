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
        DB::statement("CREATE OR ALTER VIEW dbo.urutan_radiologi_v
AS
SELECT    row_number() OVER (PARTITION BY year(tgl_daftar),month(tgl_daftar) order by tgl_daftar ) as urutan,no_kunjungan,kode_penunjang
FROM         dbo.pm_tc_penunjang
WHERE     (kode_bagian = '050201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [urutan_radiologi_v]");
    }
};
