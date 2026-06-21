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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_rencana_operasi_v
AS
SELECT     dbo.tc_rencana_operasi.id_rencana_operasi, dbo.tc_rencana_operasi.no_registrasi, dbo.tc_rencana_operasi.no_mr, dbo.tc_rencana_operasi.nama_pasien, dbo.tc_rencana_operasi.tgl_rencana, 
                      dbo.tc_rencana_operasi.status, dbo.tc_rencana_operasi.jenis_op, dbo.tc_rencana_operasi.no_kunjungan, dbo.tc_rencana_operasi.kode_booking, 
                      dbo.tc_rencana_operasi.kode_bagian_poli AS kode_bagian, dbo.tc_rencana_operasi.init, dbo.tc_rencana_operasi.flag_kirim_th, dbo.mt_bagian.nama_bagian
FROM         dbo.tc_rencana_operasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_rencana_operasi.kode_bagian_poli = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_rencana_operasi_v]");
    }
};
