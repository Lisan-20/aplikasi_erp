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
        DB::statement("CREATE VIEW dbo.update_dr_pengirim
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.pm_tc_penunjang.dr_pengirim, dbo.pm_tc_penunjang.kode_bagian, dbo.pm_tc_penunjang.tgl_daftar
FROM         dbo.pm_tc_penunjang INNER JOIN
                      dbo.mt_karyawan ON dbo.pm_tc_penunjang.dr_pengirim = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_dr_pengirim]");
    }
};
