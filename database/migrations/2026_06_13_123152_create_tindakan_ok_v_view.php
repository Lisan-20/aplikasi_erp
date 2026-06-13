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
        DB::statement("CREATE VIEW dbo.tindakan_ok_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.referensi, 
                      dbo.mt_master_tarif_detail_bedah.kode_tarif AS Expr1, dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian = '030901') AND (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4 IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tindakan_ok_v]");
    }
};
