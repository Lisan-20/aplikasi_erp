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
        DB::statement("CREATE VIEW dbo.v_tc_transaksi_payroll
AS
SELECT        dbo.tc_transaksi_payroll.id_tc_trans, dbo.dc_transaksi_detail.id_kd_transaksi, dbo.dc_transaksi_detail.nama_transkasi AS nama_transkasi_detail, dbo.tc_transaksi_payroll.npp, 
                         dbo.tc_transaksi_payroll.id_kd_transaksi_det, dbo.tc_transaksi_payroll.nominal, dbo.tc_transaksi_payroll.uraian_transaksi, dbo.tc_transaksi_payroll.tgl_mulai, dbo.tc_transaksi_payroll.tgl_akhir, 
                         dbo.tc_transaksi_payroll.tgl_input, dbo.tc_transaksi_payroll.id_user, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.kode_bagian, dbo.mt_bagian.nama_bagian AS bagian, dbo.tc_transaksi_payroll.status, 
                         dbo.tc_transaksi_payroll.bln_gaji, dbo.tc_transaksi_payroll.thn_gaji, dbo.tc_transaksi_payroll.flag_konstant
FROM            dbo.dc_transaksi_detail INNER JOIN
                         dbo.tc_transaksi_payroll ON dbo.dc_transaksi_detail.id_kd_transaksi_det = dbo.tc_transaksi_payroll.id_kd_transaksi_det INNER JOIN
                         dbo.mt_karyawan ON dbo.tc_transaksi_payroll.npp = dbo.mt_karyawan.npp INNER JOIN
                         dbo.dc_transaksi ON dbo.dc_transaksi_detail.id_kd_transaksi = dbo.dc_transaksi.id_kd_transaksi INNER JOIN
                         dbo.mt_bagian ON dbo.mt_karyawan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_transaksi_payroll.id_tc_trans, dbo.dc_transaksi_detail.id_kd_transaksi, dbo.dc_transaksi_detail.nama_transkasi, dbo.tc_transaksi_payroll.npp, dbo.tc_transaksi_payroll.id_kd_transaksi_det, 
                         dbo.tc_transaksi_payroll.nominal, dbo.tc_transaksi_payroll.uraian_transaksi, dbo.tc_transaksi_payroll.tgl_mulai, dbo.tc_transaksi_payroll.tgl_akhir, dbo.tc_transaksi_payroll.tgl_input, 
                         dbo.tc_transaksi_payroll.id_user, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_transaksi_payroll.status, dbo.tc_transaksi_payroll.bln_gaji, 
                         dbo.tc_transaksi_payroll.thn_gaji, dbo.tc_transaksi_payroll.flag_konstant
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tc_transaksi_payroll]");
    }
};
