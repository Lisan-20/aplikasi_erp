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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_tindakan_bedah_v
AS
SELECT     dbo.tc_bedah.id_bedah, mt_master_tarif_1.nama_tarif, dbo.tc_bedah.nama_tindakan, dbo.tc_bedah.jenis_anestesi, dbo.tc_bedah.tgl_transaksi, 
                      dbo.tc_bedah.no_kunjungan, dbo.tc_bedah.no_registrasi, dbo.tc_bedah.no_mr, dbo.tc_bedah.kode_dr_bedah, dbo.tc_bedah.kode_dr_anestesi
FROM         dbo.tc_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_tindakan_bedah_v]");
    }
};
