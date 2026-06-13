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
        DB::statement("CREATE VIEW dbo.v_tarif_paket_sectio
AS
SELECT     dbo.mt_master_tarif_sectio.nama_tarif, dbo.mt_master_tarif_paket_sectio.kelas_paket, dbo.mt_master_tarif_paket_sectio.kode_paket, 
                      dbo.mt_master_tarif_paket_sectio.bill_rs, dbo.mt_master_tarif_sectio.kode_tarif, dbo.mt_master_tarif_sectio.kode_bagian, dbo.mt_master_tarif_sectio.jenis_tindakan, 
                      dbo.mt_master_tarif_paket_sectio.kode_klas, dbo.mt_master_tarif_sectio.paket_ibu, dbo.mt_master_tarif_paket_sectio.bill_dr1
FROM         dbo.mt_master_tarif_paket_sectio INNER JOIN
                      dbo.mt_master_tarif_sectio ON dbo.mt_master_tarif_paket_sectio.kode_tarif = dbo.mt_master_tarif_sectio.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tarif_paket_sectio]");
    }
};
