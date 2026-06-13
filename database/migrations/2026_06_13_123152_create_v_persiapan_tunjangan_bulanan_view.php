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
        DB::statement("CREATE VIEW dbo.v_persiapan_tunjangan_bulanan
AS
SELECT     dbo.tc_transaksi_payroll.npp, dbo.tc_transaksi_payroll.id_kd_transaksi_det, dbo.tc_transaksi_payroll.nominal AS tunjangan, dbo.tc_transaksi_payroll.tgl_mulai, dbo.tc_transaksi_payroll.tgl_akhir, 
                      dbo.tc_transaksi_payroll.id_kd_transaksi, dbo.dc_transaksi_detail.nama_transkasi, dbo.mt_periode_gaji.status_periode_gaji, dbo.mt_periode_gaji.periode_gaji, dbo.mt_periode_gaji.periode_awal, 
                      dbo.mt_periode_gaji.periode_akhir, dbo.mt_periode_gaji.id_periode_gaji, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.nama_bank, dbo.mt_karyawan.no_rekening, 
                      dbo.mt_karyawan.npp AS npp_master, dbo.tc_transaksi_payroll.id_tc_trans, MONTH(dbo.mt_periode_gaji.periode_akhir) AS bulan, YEAR(dbo.mt_periode_gaji.periode_akhir) AS tahun, 
                      dbo.mt_periode_gaji.input_id, dbo.mt_periode_gaji.input_tgl, dbo.mt_periode_gaji.status, dbo.mt_periode_gaji.status_tgl, dbo.dc_transaksi_detail.nama_transaksi, 
                      dbo.dc_transaksi_detail.keterangan
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_transaksi_payroll INNER JOIN
                      dbo.dc_transaksi_detail ON dbo.tc_transaksi_payroll.id_kd_transaksi = dbo.dc_transaksi_detail.id_kd_transaksi AND 
                      dbo.tc_transaksi_payroll.id_kd_transaksi_det = dbo.dc_transaksi_detail.id_kd_transaksi_det ON dbo.mt_karyawan.npp = dbo.tc_transaksi_payroll.npp CROSS JOIN
                      dbo.mt_periode_gaji
WHERE     (dbo.tc_transaksi_payroll.id_kd_transaksi = N'2') AND (dbo.mt_periode_gaji.status_periode_gaji IS NULL) AND (dbo.tc_transaksi_payroll.tgl_mulai BETWEEN dbo.mt_periode_gaji.periode_awal AND
                       dbo.mt_periode_gaji.periode_akhir)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_persiapan_tunjangan_bulanan]");
    }
};
