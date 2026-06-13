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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_dokter_bagian_v
AS
SELECT     dbo.mt_dokter_bagian.kd_bagian, dbo.mt_dokter_bagian.kode_dokter, dbo.mt_bagian.nama_bagian
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_dokter_bagian ON dbo.mt_bagian.kode_bagian = dbo.mt_dokter_bagian.kd_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_dokter_bagian_v]");
    }
};
