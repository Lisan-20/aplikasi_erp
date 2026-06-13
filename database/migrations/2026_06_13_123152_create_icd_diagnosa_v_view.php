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
        DB::statement("CREATE VIEW dbo.icd_diagnosa_v
AS
SELECT     dbo.mt_bagian.nama_bagian, dbo.mt_icd_diagnosa.kode_icd, dbo.mt_icd_diagnosa.nama_diagnosa, dbo.mt_icd_diagnosa.kode_bagian
FROM         dbo.mt_icd_diagnosa INNER JOIN
                      dbo.mt_bagian ON dbo.mt_icd_diagnosa.kode_bagian = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [icd_diagnosa_v]");
    }
};
