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
        DB::statement("CREATE OR ALTER VIEW dbo.v_bed_update
AS
SELECT     TOP (100) PERCENT COUNT(dbo.v_tarif_bedah_klas.kode_tarif) AS Expr1, dbo.v_tarif_bedah_klas.kode_tarif, dbo.v_tarif_bedah_klas.nama_tarif, 
                      dbo.mt_master_tarif.referensi, dbo.mt_master_tarif.tingkatan
FROM         dbo.v_tarif_bedah_klas INNER JOIN
                      dbo.mt_master_tarif ON dbo.v_tarif_bedah_klas.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.v_tarif_bedah_klas.kode_tarif, dbo.v_tarif_bedah_klas.nama_tarif, dbo.mt_master_tarif.referensi, dbo.mt_master_tarif.tingkatan
HAVING      (COUNT(dbo.v_tarif_bedah_klas.kode_tarif) < 6)
ORDER BY dbo.mt_master_tarif.referensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bed_update]");
    }
};
