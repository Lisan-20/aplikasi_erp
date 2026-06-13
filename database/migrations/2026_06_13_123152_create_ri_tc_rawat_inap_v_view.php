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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_tc_rawat_inap_v
AS
SELECT     dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.kode_ruangan, 
                      dbo.ri_tc_rawatinap.status_batal
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan
WHERE     (dbo.ri_tc_rawatinap.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_tc_rawat_inap_v]");
    }
};
