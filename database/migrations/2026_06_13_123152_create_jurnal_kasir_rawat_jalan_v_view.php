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
        DB::statement("CREATE VIEW dbo.jurnal_kasir_rawat_jalan_v
AS
SELECT     dbo.kasir_rj_v.tgl_jam, dbo.kasir_rj_v.kasir, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.mapping_transaksi_rs_v.nama_kredit, dbo.mapping_transaksi_rs_v.nama_debet, 
                      dbo.mapping_transaksi_rs_v.nama_bagian, dbo.kasir_rj_v.seri_kuitansi, dbo.kasir_rj_v.no_kuitansi, dbo.kasir_rj_v.kode_tc_trans_kasir, dbo.kasir_rj_v.kode_bagian, 
                      dbo.kasir_rj_v.flag_jurnal, dbo.kasir_rj_v.nk, dbo.kasir_rj_v.nk_karyawan, dbo.kasir_rj_v.nk_perusahaan, dbo.kasir_rj_v.nk_askes, dbo.kasir_rj_v.tunai, 
                      dbo.kasir_rj_v.debet, dbo.kasir_rj_v.kredit, dbo.kasir_rj_v.nd, dbo.kasir_rj_v.kode_perusahaan, dbo.kasir_rj_v.no_mr, dbo.kasir_rj_v.no_registrasi, 
                      dbo.mapping_transaksi_rs_v.kode_proses
FROM         dbo.kasir_rj_v INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.kasir_rj_v.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.kasir_rj_v.seri_kuitansi IN ('RJ', 'AJ')) AND (dbo.kasir_rj_v.flag_jurnal = 0) AND (dbo.mapping_transaksi_rs_v.kode_proses = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_kasir_rawat_jalan_v]");
    }
};
