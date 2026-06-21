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
        DB::statement("CREATE OR ALTER VIEW dbo.jml_bed_v
AS
SELECT     kode_bagian, kode_klas, COUNT(no_bed) AS jml_bed
FROM         dbo.mt_ruangan
GROUP BY kode_bagian, kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_bed_v]");
    }
};
