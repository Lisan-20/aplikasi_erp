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
        DB::statement("CREATE OR ALTER VIEW dbo.slip_gaji_potongan_ok_v
AS
SELECT     dbo.slip_gaji_3v.npp, dbo.slip_gaji_3v.id_mt_periode_gaji, dbo.slip_gaji_3v.nilai, dbo.slip_gaji_3v.ket, dbo.slip_gaji_3v.urut, dbo.tc_gaji_tiap_bulan.id_tc_thp, 
                      dbo.tc_gaji_tiap_bulan.bulan, dbo.tc_gaji_tiap_bulan.tahun
FROM         dbo.slip_gaji_3v INNER JOIN
                      dbo.tc_gaji_tiap_bulan ON dbo.slip_gaji_3v.id_mt_periode_gaji = dbo.tc_gaji_tiap_bulan.id_periode_gaji AND dbo.slip_gaji_3v.npp = dbo.tc_gaji_tiap_bulan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_gaji_potongan_ok_v]");
    }
};
