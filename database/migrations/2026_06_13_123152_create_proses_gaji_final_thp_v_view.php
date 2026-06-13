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
        DB::statement("CREATE VIEW dbo.proses_gaji_final_thp_v
AS
SELECT     dbo.mt_periode_gaji.status, dbo.mt_periode_gaji.status_tgl, dbo.mt_periode_gaji.input_id, dbo.mt_periode_gaji.input_tgl, dbo.mt_periode_gaji.periode_awal, dbo.mt_periode_gaji.periode_akhir, 
                      dbo.mt_periode_gaji.periode_gaji, dbo.mt_periode_gaji.id_periode_gaji, dbo.tc_gaji_pokok.gaji_pokok, dbo.tc_gaji_pokok.npp, dbo.tc_gaji_pokok.nama_pegawai, dbo.tc_gaji_pokok.tahun, 
                      dbo.tc_gaji_pokok.bulan, dbo.mt_periode_gaji.status_periode_gaji
FROM         dbo.mt_periode_gaji INNER JOIN
                      dbo.tc_gaji_pokok ON dbo.mt_periode_gaji.id_periode_gaji = dbo.tc_gaji_pokok.id_mt_periode_gaji
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_gaji_final_thp_v]");
    }
};
