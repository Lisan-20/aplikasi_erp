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
        DB::statement("CREATE OR ALTER VIEW dbo.bd_tc_bayar_gaji_v
AS
SELECT        dbo.bd_tc_proses_gaji.id_bd_tc_proses_gaji, dbo.bd_tc_proses_gaji.id_periode_gaji, dbo.bd_tc_proses_gaji.tgl_pembentukan, dbo.bd_tc_proses_gaji.no_bukti, 
                         dbo.bd_tc_proses_gaji.jumlah, dbo.bd_tc_proses_gaji.status_bayar, dbo.bd_tc_proses_gaji.tgl_ver, dbo.bd_tc_proses_gaji.status_ver, 
                         dbo.mt_periode_gaji.periode_gaji, dbo.mt_periode_gaji.periode_awal, dbo.mt_periode_gaji.periode_akhir
FROM            dbo.mt_periode_gaji INNER JOIN
                         dbo.bd_tc_proses_gaji ON dbo.mt_periode_gaji.id_periode_gaji = dbo.bd_tc_proses_gaji.id_periode_gaji
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_bayar_gaji_v]");
    }
};
