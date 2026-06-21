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
        DB::statement("
CREATE OR ALTER VIEW dbo.tc_biaya_op_v
AS
SELECT     dbo.tc_biaya_op.id_tc_biaya_op, dbo.tc_biaya_op.id_dd_anggaran, dbo.dd_anggaran.acc_no, dbo.dd_anggaran.id_dc_modul, 
                      dbo.dc_modul.nama_modul, dbo.dd_anggaran.jenis_anggaran, dbo.dd_anggaran.status_jenis_ang, dbo.dd_anggaran.tgl_jenis_ang, 
                      dbo.dd_anggaran.kowil, dbo.tc_biaya_op.tgl_biaya_op, dbo.tc_biaya_op.tgl_tagih_biaya_op, dbo.tc_biaya_op.bukti_biaya_op, 
                      dbo.tc_biaya_op.keterangan_biaya_op, dbo.tc_biaya_op.nilai_debet_biaya_op, dbo.tc_biaya_op.nilai_kredit_biaya_op, 
                      dbo.tc_biaya_op.status_biaya_op, dbo.dc_master_account.acc_nama, dbo.dc_master_account.kat, dbo.dc_master_account.type, 
                      dbo.dc_master_account.m_s, dbo.dc_master_account.acc_status, dbo.dc_master_account.acc_type, dbo.dc_master_account.acc_level
FROM         dbo.dd_anggaran INNER JOIN
                      dbo.dc_master_account ON dbo.dd_anggaran.acc_no = dbo.dc_master_account.acc_no INNER JOIN
                      dbo.tc_biaya_op ON dbo.dd_anggaran.id_dd_anggaran = dbo.tc_biaya_op.id_dd_anggaran INNER JOIN
                      dbo.dc_modul ON dbo.dd_anggaran.id_dc_modul = dbo.dc_modul.id_dc_modul

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_biaya_op_v]");
    }
};
