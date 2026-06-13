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
        DB::statement("CREATE VIEW dbo.jurnal_uang_muka_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.nama_bagian, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.tc_trans_kasir.debet + dbo.tc_trans_kasir.kredit + dbo.tc_trans_kasir.tunai AS uang_muka, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.kode_inap, dbo.tc_trans_kasir.tgl_ver, 
                      dbo.tc_trans_kasir.flag_jurnal, dbo.tc_trans_kasir.kd_bank_cc
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tc_trans_kasir.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 7) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_uang_muka_v]");
    }
};
