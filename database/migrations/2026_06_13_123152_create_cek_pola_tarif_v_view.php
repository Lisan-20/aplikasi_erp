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
        DB::statement("CREATE VIEW dbo.cek_pola_tarif_v
AS
SELECT     dbo.mt_pola_tarif.*, dbo.mt_master_tarif.nama_tarif, dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_pola_tarif ON dbo.mt_master_tarif.kode_tarif = dbo.mt_pola_tarif.kode_tarif INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_pola_tarif.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.mt_master_tarif.nama_tarif LIKE 'Pem dokter%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pola_tarif_v]");
    }
};
