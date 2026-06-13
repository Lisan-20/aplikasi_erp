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
        DB::statement("CREATE OR ALTER VIEW dbo.th_icd10_pasien_gabung_v
AS
SELECT     no_mr, tgl_jam, kode_icd, kode_bagian, diagnosa, CAST(no_registrasi AS varchar) AS no_registrasi, no_kunjungan, 'baru' AS status_system
FROM         dbo.th_icd10_pasien_ok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_gabung_v]");
    }
};
