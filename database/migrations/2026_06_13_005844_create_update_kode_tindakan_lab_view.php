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
        DB::statement("CREATE OR ALTER VIEW dbo.update_kode_tindakan_lab
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_b.kode_tarif AS kode_tarif2, 
                      dbo.mt_master_tarif_b.kode_tindakan AS kode_tindakan2, dbo.mt_master_tarif_b.nama_tarif AS nama_tarif2
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_b ON dbo.mt_master_tarif.nama_tarif = dbo.mt_master_tarif_b.nama_tarif AND 
                      dbo.mt_master_tarif.kode_bagian = dbo.mt_master_tarif_b.kode_bagian
WHERE     (dbo.mt_master_tarif.kode_bagian = '050101') AND (dbo.mt_master_tarif.tingkatan = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_tindakan_lab]");
    }
};
