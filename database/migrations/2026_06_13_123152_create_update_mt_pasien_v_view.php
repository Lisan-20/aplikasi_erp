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
        DB::statement("CREATE VIEW dbo.update_mt_pasien_v
AS
SELECT     TOP (100) PERCENT NoMR, 3 AS kode_kelompok, Instansi
FROM         dbo.Biodata
WHERE     (Instansi <> '') AND (Instansi <> 'umum') AND (Instansi LIKE '%inko%')
ORDER BY Instansi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_mt_pasien_v]");
    }
};
