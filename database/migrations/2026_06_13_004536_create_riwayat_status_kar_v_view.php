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
        DB::statement("CREATE OR ALTER VIEW dbo.riwayat_status_kar_v
AS
SELECT     dbo.tc_status_pegawai.npp, dbo.dc_status_karyawan.status_kar, dbo.tc_status_pegawai.no_sk, dbo.tc_status_pegawai.status_tgl, dbo.tc_status_pegawai.berakhir_tgl, 
                      dbo.tc_status_pegawai.id_status, dbo.tc_status_pegawai.id_tc_status_peg, dbo.tc_status_pegawai.awal_tgl, dbo.tc_status_pegawai.ko_wil, dbo.tc_status_pegawai.kontrak_ke, 
                      dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.kode_bagian, dbo.mt_karyawan.id_status AS Expr1, DATEDIFF(month, GETDATE(), dbo.tc_status_pegawai.berakhir_tgl) AS sisa_bulan, 
                      dbo.tc_status_pegawai.ort_no_srt, dbo.tc_status_pegawai.sk_no_srt, dbo.tc_status_pegawai.sk_dir_no_srt
FROM         dbo.tc_status_pegawai INNER JOIN
                      dbo.dc_status_karyawan ON dbo.tc_status_pegawai.id_status = dbo.dc_status_karyawan.id_status INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_status_pegawai.npp = dbo.mt_karyawan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [riwayat_status_kar_v]");
    }
};
