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
        DB::statement("CREATE OR ALTER VIEW dbo.SDM_keluar_bln_v
AS
SELECT     dbo.SDM_karyawan_keluar_v.npp, dbo.SDM_gaji_akhir_v.id_tc_thp, dbo.SDM_karyawan_keluar_v.nama_pegawai, dbo.tc_gaji_tiap_bulan.tahun AS thn, dbo.tc_gaji_tiap_bulan.bulan AS bln
FROM         dbo.tc_gaji_tiap_bulan INNER JOIN
                      dbo.SDM_gaji_akhir_v ON dbo.tc_gaji_tiap_bulan.id_tc_thp = dbo.SDM_gaji_akhir_v.id_tc_thp RIGHT OUTER JOIN
                      dbo.SDM_karyawan_keluar_v ON dbo.SDM_gaji_akhir_v.npp = dbo.SDM_karyawan_keluar_v.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [SDM_keluar_bln_v]");
    }
};
