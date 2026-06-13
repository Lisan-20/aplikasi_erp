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
        DB::statement("CREATE VIEW dbo.slip_gaji_ok_v
AS
SELECT     dbo.slip_gaji_2v.npp, dbo.tc_gaji_tiap_bulan.periode, dbo.tc_gaji_tiap_bulan.bulan, dbo.tc_gaji_tiap_bulan.tahun, dbo.slip_gaji_2v.nilai, dbo.slip_gaji_2v.ket, 
                      dbo.slip_gaji_2v.urut, dbo.tc_gaji_tiap_bulan.id_tc_thp, dbo.tc_gaji_tiap_bulan.nama_pegawai
FROM         dbo.tc_gaji_tiap_bulan INNER JOIN
                      dbo.slip_gaji_2v ON dbo.tc_gaji_tiap_bulan.npp = dbo.slip_gaji_2v.npp AND dbo.tc_gaji_tiap_bulan.id_periode_gaji = dbo.slip_gaji_2v.id_mt_periode_gaji
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_gaji_ok_v]");
    }
};
