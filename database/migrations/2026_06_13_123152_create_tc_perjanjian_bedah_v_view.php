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
        DB::statement("CREATE VIEW dbo.tc_perjanjian_bedah_v
AS
SELECT     TOP (100) PERCENT dbo.tc_rencana_operasi.kode_bagian_poli AS kodepoli, dbo.mt_bagian.kode_poli_vclaim, dbo.tc_rencana_operasi.no_mr, dbo.tc_rencana_operasi.nama_pasien, 
                      dbo.tc_rencana_operasi.no_registrasi, dbo.tc_rencana_operasi.tgl_rencana AS tanggaloperasi, dbo.tc_rencana_operasi.kode_booking AS kodebooking, 
                      dbo.tc_rencana_operasi.jenis_op AS jenistindakan, dbo.mt_bagian.nama_bagian AS namapoli, dbo.tc_rencana_operasi.status AS terlaksana, dbo.mt_master_pasien.nik, GETDATE() 
                      AS lastupdate
FROM         dbo.tc_rencana_operasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_rencana_operasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_rencana_operasi.kode_bagian_poli = dbo.mt_bagian.kode_bagian
ORDER BY tanggaloperasi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_perjanjian_bedah_v]");
    }
};
