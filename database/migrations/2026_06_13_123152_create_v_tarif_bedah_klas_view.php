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
        DB::statement("CREATE VIEW dbo.v_tarif_bedah_klas
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif.kode_tarif, 
                      dbo.mt_master_tarif_detail_bedah.kode_tarif AS Expr1, dbo.mt_klas.nama_klas, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, 
                      dbo.mt_master_tarif.nama_tarif
FROM         dbo.mt_klas INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_klas.kode_klas = dbo.mt_master_tarif_detail_bedah.kode_klas RIGHT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.nama_tarif
HAVING      (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif.kode_bagian = '030901')
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_bedah.kode_klas DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tarif_bedah_klas]");
    }
};
