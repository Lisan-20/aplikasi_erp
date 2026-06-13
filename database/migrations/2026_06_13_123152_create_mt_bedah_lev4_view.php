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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_bedah_lev4
AS
SELECT     dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.referensi, 
                      dbo.mt_bedah_lev3.nama_tarif AS nama_tarif_lev3, dbo.mt_master_tarif.kode_tarif AS kode_tarif_lev4, dbo.mt_bedah_lev3.kode_tarif_lev3
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_bedah_lev3 ON dbo.mt_master_tarif.referensi = dbo.mt_bedah_lev3.kode_tarif_lev3
WHERE     (dbo.mt_master_tarif.kode_bagian = '030901') AND (dbo.mt_master_tarif.tingkatan = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bedah_lev4]");
    }
};
