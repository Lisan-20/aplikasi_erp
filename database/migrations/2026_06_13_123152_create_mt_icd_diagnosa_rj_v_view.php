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
        DB::statement("CREATE VIEW dbo.mt_icd_diagnosa_rj_v
AS
SELECT        TOP (100) PERCENT dbo.mt_icd_diagnosa.nama_diagnosa, dbo.mt_icd_diagnosa.kode_icd_diagnosa, dbo.mt_icd_diagnosa.kode_icd
FROM            dbo.mt_icd_diagnosa LEFT OUTER JOIN
                         dbo.mt_icd_inacbg_diagnosa_rj_v ON dbo.mt_icd_diagnosa.kode_icd = dbo.mt_icd_inacbg_diagnosa_rj_v.icd_x
GROUP BY dbo.mt_icd_diagnosa.nama_diagnosa, dbo.mt_icd_diagnosa.kode_icd_diagnosa, dbo.mt_icd_diagnosa.kode_icd
ORDER BY dbo.mt_icd_diagnosa.nama_diagnosa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_icd_diagnosa_rj_v]");
    }
};
