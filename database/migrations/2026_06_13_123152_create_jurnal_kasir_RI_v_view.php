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
        DB::statement("CREATE VIEW dbo.jurnal_kasir_RI_v
AS
SELECT     dbo.kasir_RI_v.kode_tc_trans_kasir, dbo.kasir_RI_v.seri_kuitansi, dbo.kasir_RI_v.no_kuitansi, dbo.kasir_RI_v.tgl_jam, dbo.kasir_RI_v.no_mr, 
                      dbo.kasir_RI_v.no_registrasi, dbo.kasir_RI_v.kasir, dbo.kasir_RI_v.tunai, dbo.kasir_RI_v.debet, dbo.kasir_RI_v.kredit, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.kasir_RI_v.nd, dbo.kasir_RI_v.nk, dbo.kasir_RI_v.nk_karyawan, dbo.kasir_RI_v.nk_perusahaan, 
                      dbo.kasir_RI_v.nk_askes, dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mt_bagian.nama_bagian, dbo.kasir_RI_v.kode_bagian, dbo.kasir_RI_v.kode_perusahaan, 
                      dbo.kasir_RI_v.flag_jurnal
FROM         dbo.kasir_RI_v INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.kasir_RI_v.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian INNER JOIN
                      dbo.mt_bagian ON dbo.kasir_RI_v.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 1) AND (dbo.kasir_RI_v.seri_kuitansi = 'RI') AND (dbo.kasir_RI_v.flag_jurnal = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_kasir_RI_v]");
    }
};
