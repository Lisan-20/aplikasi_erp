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
        DB::statement("CREATE VIEW dbo.v_gaji_bulanan
AS
SELECT     dbo.tc_gaji_pokok.id_mt_periode_gaji, dbo.tc_gaji_pokok.id_tc_gaji_pokok, dbo.tc_gaji_pokok.periode_gaji, dbo.tc_gaji_pokok.tahun, dbo.tc_gaji_pokok.bulan, 
                      dbo.tc_gaji_pokok.kelompok, dbo.tc_gaji_pokok.npp, dbo.tc_gaji_pokok.gaji_pokok, dbo.tc_gaji_pokok.nama_pegawai, dbo.tc_gaji_pokok.gg, dbo.tc_gaji_pokok.tg, 
                      dbo.tc_gaji_pokok.input_id, dbo.tc_gaji_pokok.input_tgl, dbo.tc_gaji_pokok.status, dbo.tc_gaji_pokok.status_tgl
FROM         dbo.tc_gaji_pokok INNER JOIN
                      dbo.mt_periode_gaji ON dbo.tc_gaji_pokok.id_mt_periode_gaji = dbo.mt_periode_gaji.id_periode_gaji
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_gaji_bulanan]");
    }
};
