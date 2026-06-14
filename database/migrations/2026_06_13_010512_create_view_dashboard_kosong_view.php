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
        DB::statement("CREATE OR ALTER VIEW dbo.view_dashboard_kosong
AS
SELECT     COUNT(kode_bagian) AS jml_kosong, kode_bagian, kode_klas_bpjs, nama_bagian
FROM         dbo.view_dashboard
WHERE     (status IS NULL OR
                      status = '') AND (keterangan NOT LIKE '%TITIP%')
GROUP BY kode_bagian, kode_klas_bpjs, nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard_kosong]");
    }
};
