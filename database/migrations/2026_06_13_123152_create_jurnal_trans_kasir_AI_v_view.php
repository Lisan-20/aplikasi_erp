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
        DB::statement("CREATE VIEW dbo.jurnal_trans_kasir_AJ_v
AS
SELECT     TOP (100) PERCENT dbo.tran_kasir.kode_tran_kasir, dbo.tran_kasir.kode_tc_trans_kasir, dbo.tran_kasir.no_registrasi, dbo.tran_kasir.no_mr, 
                      dbo.tran_kasir.no_kuitansi, dbo.tran_kasir.seri_kuitansi, dbo.tran_kasir.no_induk, dbo.tran_kasir.tgl_jam, dbo.tran_kasir.jumlah, dbo.tran_kasir.kode_bagian, 
                      dbo.tran_kasir.flag_jurnal, dbo.tran_kasir.tgl_proses, dbo.tran_kasir.kode, dbo.mapping_transaksi_rs_v.nama_proses, 
                      dbo.mapping_transaksi_rs_v.nama_jenis_proses, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.nama_debet, dbo.mt_bagian.nama_bagian, 
                      dbo.tran_kasir.kode_perusahaan, dbo.mapping_transaksi_rs_v.acc_kredit
FROM         dbo.tran_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tran_kasir.kode = dbo.mapping_transaksi_rs_v.kode AND 
                      dbo.tran_kasir.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian INNER JOIN
                      dbo.mt_bagian ON dbo.tran_kasir.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 1) AND (dbo.tran_kasir.flag_jurnal IS NULL) AND (dbo.tran_kasir.seri_kuitansi = 'AI')
ORDER BY dbo.tran_kasir.seri_kuitansi, dbo.tran_kasir.no_kuitansi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_trans_kasir_AI_v]");
    }
};
