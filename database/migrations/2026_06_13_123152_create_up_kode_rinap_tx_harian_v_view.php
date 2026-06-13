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
        DB::statement("CREATE VIEW dbo.up_kode_rinap_tx_harian_v
AS
SELECT     dbo.tx_harian.kel_jurnal, dbo.tx_harian.no_registrasi, dbo.tx_harian.no_mr, dbo.tx_harian.kode_inap, dbo.ri_tc_rawatinap.kode_inap AS kode_inap_up
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.tx_harian ON dbo.tc_kunjungan.no_registrasi = dbo.tx_harian.no_registrasi
WHERE     (dbo.tx_harian.kel_jurnal = '2') AND (dbo.tx_harian.kode_inap IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_kode_rinap_tx_harian_v]");
    }
};
