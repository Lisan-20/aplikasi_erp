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
        DB::statement("CREATE OR ALTER VIEW dbo.updt_kode_dr
AS
SELECT        dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_karyawan.kode_paramedis
FROM            dbo.tc_trans_pelayanan INNER JOIN
                         dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [updt_kode_dr]");
    }
};
