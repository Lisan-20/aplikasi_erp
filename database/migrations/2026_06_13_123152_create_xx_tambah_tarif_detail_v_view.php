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
        DB::statement("CREATE VIEW dbo.xx_tambah_tarif_detail_v
AS
SELECT     '1' AS kode_klas, 57000 AS bill_rs, 52000 AS bill_dr1, 0 AS bill_dr2, dbo.mt_master_tarif_detail.kode_tgl_tarif, dbo.mt_master_tarif_detail.kode_tarif, 
                      109000 AS total
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif.kode_bagian = '030501') AND ('1' = '1')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xx_tambah_tarif_detail_v]");
    }
};
