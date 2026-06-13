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
        DB::statement("CREATE VIEW dbo.th_icd10_pasien_v
AS
SELECT     kode_icd, diagnosa, no_registrasi, kode_icd_pasien AS Expr1
FROM         dbo.th_icd10_pasien
WHERE     (no_registrasi = 4049)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_v]");
    }
};
