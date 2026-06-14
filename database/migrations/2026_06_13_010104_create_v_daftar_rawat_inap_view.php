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
        DB::statement("CREATE OR ALTER VIEW dbo.v_daftar_rawat_inap
AS
SELECT     dbo.tc_kunjungan.no_registrasi, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kode_ruangan, dbo.tc_kunjungan.status_batal
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan
WHERE     (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_daftar_rawat_inap]");
    }
};
