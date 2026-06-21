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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_kasir_pembelian_obat_bebas_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_kuitansi_bendahara, 
                      dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, 
                      dbo.tc_trans_kasir.tambahan, dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.no_debet, dbo.tc_trans_kasir.kredit, 
                      dbo.tc_trans_kasir.no_kredit, dbo.tc_trans_kasir.cetak_kartu, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_karyawan, 
                      dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nk_askes, dbo.tc_trans_kasir.no_mr_karyawan, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.tc_trans_kasir.no_batch_cc, dbo.tc_trans_kasir.kd_bank_cc, dbo.tc_trans_kasir.kd_bank_dc, dbo.tc_trans_kasir.no_batch_dc, dbo.tc_trans_kasir.pembulatan, 
                      dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.keterangan, dbo.tc_trans_kasir.kd_inv_umum_tx, 
                      dbo.tc_trans_kasir.kd_inv_askes, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.kd_inv_kary_tx, dbo.tc_trans_kasir.flag_jurnal, dbo.tc_trans_kasir.tgl_ver, 
                      dbo.tc_trans_kasir.user_ver, dbo.tc_trans_kasir.kd_inv_cc_tx, dbo.tc_trans_kasir.kd_inv_dc_tx, dbo.tc_trans_kasir.kode_shift, dbo.tc_trans_kasir.kode_loket, 
                      dbo.tc_trans_kasir.materai, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.tgl_batal, dbo.tc_trans_kasir.user_batal, 
                      dbo.mapping_transaksi_rs_v.kode_proses, dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.nama_bagian, dbo.jurnal_pembelian_obat_bebas_v2.nama_pasien_layan, 
                      dbo.jurnal_pembelian_obat_bebas_v2.nama_bagian AS Expr1, dbo.jurnal_pembelian_obat_bebas_v2.no_resep
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.jurnal_pembelian_obat_bebas_v2 ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.jurnal_pembelian_obat_bebas_v2.kode_tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.jurnal_pembelian_obat_bebas_v2.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_kasir_pembelian_obat_bebas_v]");
    }
};
