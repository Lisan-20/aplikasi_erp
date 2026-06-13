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
        DB::statement("CREATE VIEW dbo.diagnosa_plafond_bpjs_v
AS
SELECT        TOP (100) PERCENT dbo.mt_icd_diagnosa_plafond.klas, dbo.mt_icd_diagnosa_plafond.plafond_awal, dbo.mt_klas.nama_klas, dbo.mt_icd_diagnosa.id_mt_icd_diagnosa, 
                         dbo.mt_icd_diagnosa.kode_icd_diagnosa, dbo.mt_icd_diagnosa.nama_diagnosa, dbo.mt_icd_diagnosa.kode_icd, dbo.mt_master_icd10.nama_icd
FROM            dbo.mt_icd_diagnosa INNER JOIN
                         dbo.mt_klas INNER JOIN
                         dbo.mt_icd_diagnosa_plafond ON dbo.mt_klas.kode_klas = dbo.mt_icd_diagnosa_plafond.klas ON dbo.mt_icd_diagnosa.id_mt_icd_diagnosa = dbo.mt_icd_diagnosa_plafond.id_mt_icd_diagnosa INNER JOIN
                         dbo.mt_master_icd10 ON dbo.mt_icd_diagnosa.kode_icd = dbo.mt_master_icd10.icd_10
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diagnosa_plafond_bpjs_v]");
    }
};
