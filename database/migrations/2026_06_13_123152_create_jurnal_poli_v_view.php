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
        DB::statement("CREATE VIEW dbo.jurnal_poli_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi AS tx_tgl, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, 
                      dbo.tc_trans_pelayanan.bill_dr3, dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.bill_dr1_askes, dbo.tc_trans_pelayanan.bill_dr2_askes, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.lain_lain, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_master_tarif_detail, dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, 
                      dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.no_kamar, dbo.tc_trans_pelayanan.no_bed, 
                      dbo.tc_trans_pelayanan.kode_penunjang, dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_nk, 
                      dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.bill_rs_rujukan, dbo.tc_trans_pelayanan.bill_rs_laba_rujukan, dbo.tc_trans_pelayanan.id_dd_rujuk_rs, 
                      dbo.tc_trans_pelayanan.kamar_tindakan, dbo.tc_trans_pelayanan.biaya_lain, dbo.tc_trans_pelayanan.obat, dbo.tc_trans_pelayanan.alkes, 
                      dbo.tc_trans_pelayanan.alat_rs, dbo.tc_trans_pelayanan.adm, dbo.tc_trans_pelayanan.overhead, dbo.tc_trans_pelayanan.bhp, 
                      dbo.tc_trans_pelayanan.pendapatan_rs, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_pelayanan.flag_jurnal_pdp, dbo.tc_trans_pelayanan.obat_cover_persh, 
                      dbo.tc_trans_pelayanan.tgl_ver, dbo.ak_dd_mapping_transaksi_v.kode_bagian AS Expr1, dbo.ak_dd_mapping_transaksi_v.kode_jenis_proses, 
                      dbo.ak_dd_mapping_transaksi_v.acc_debet, dbo.ak_dd_mapping_transaksi_v.acc_kredit, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.ak_dd_mapping_transaksi_v.kode_proses, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.ak_dd_mapping_transaksi_v ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.ak_dd_mapping_transaksi_v.kode_jenis_proses
WHERE     (YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) >= 2012) AND (dbo.ak_dd_mapping_transaksi_v.kode_proses = 2) AND (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND 
                      (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_poli_v]");
    }
};
