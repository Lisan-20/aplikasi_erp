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
        DB::statement("CREATE VIEW dbo.mt_dokter_dpjp_v
AS
SELECT     dbo.tc_dpjp_rinap.no_registrasi, dbo.tc_dpjp_rinap.dr_merawat AS kode_dokter, dbo.mt_karyawan.nama_pegawai
FROM         dbo.tc_dpjp_rinap INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_dpjp_rinap.dr_merawat = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_dokter_dpjp_v]");
    }
};
