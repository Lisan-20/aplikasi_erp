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
        DB::statement("CREATE VIEW dbo.tc_obat_ruangan_v
AS
SELECT     dbo.tc_trans_pelayanan.bill_rs_jatah AS Expr1, dbo.tc_trans_pelayanan.bill_dr1_jatah AS Expr2, dbo.tc_trans_pelayanan.lain_lain AS Expr3, 
                      dbo.tc_trans_pelayanan.jumlah AS Expr4, dbo.tc_trans_pelayanan.kode_barang AS Expr5, dbo.tc_obat_ruangan.status, 
                      dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_dr3, dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.bill_dr1_askes, 
                      dbo.tc_trans_pelayanan.bill_dr2_askes, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, 
                      dbo.tc_trans_pelayanan.kode_master_tarif_detail, dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, dbo.tc_trans_pelayanan.kd_tr_resep, 
                      dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.no_kamar, dbo.tc_trans_pelayanan.no_bed, 
                      dbo.tc_trans_pelayanan.kode_penunjang, dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_trans_pelayanan.status_nk, dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.bill_rs_rujukan, 
                      dbo.tc_trans_pelayanan.bill_rs_laba_rujukan, dbo.tc_trans_pelayanan.id_dd_rujuk_rs, dbo.tc_trans_pelayanan.kamar_tindakan, 
                      dbo.tc_trans_pelayanan.biaya_lain, dbo.tc_trans_pelayanan.obat, dbo.tc_trans_pelayanan.alkes, dbo.tc_trans_pelayanan.alat_rs, 
                      dbo.tc_trans_pelayanan.adm, dbo.tc_trans_pelayanan.overhead, dbo.tc_trans_pelayanan.bhp, dbo.tc_trans_pelayanan.pendapatan_rs, 
                      dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_pelayanan.flag_jurnal_pdp, dbo.tc_trans_pelayanan.obat_cover_persh, 
                      dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_pelayanan.bill_rs_selisih, dbo.tc_trans_pelayanan.bill_dr1_selisih, 
                      dbo.tc_trans_pelayanan.bill_dr2_selisih, dbo.tc_trans_pelayanan.diskon_rs, dbo.tc_trans_pelayanan.diskon_dr1, dbo.tc_trans_pelayanan.diskon_dr2, 
                      dbo.tc_trans_pelayanan.diskon_rs_jatah, dbo.tc_trans_pelayanan.diskon_dr1_jatah, dbo.tc_trans_pelayanan.diskon_dr2_jatah, 
                      dbo.tc_trans_pelayanan.diskon_rs_selisih, dbo.tc_trans_pelayanan.diskon_dr1_selisih, dbo.tc_trans_pelayanan.diskon_dr2_selisih, 
                      dbo.tc_trans_pelayanan.id_bedah, dbo.tc_trans_pelayanan.harga_beli, dbo.tc_trans_pelayanan.flag_tarik, dbo.tc_trans_pelayanan.paket_sectio, 
                      dbo.tc_trans_pelayanan.tgl_pindah, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_pelayanan.flag_dr2, 
                      dbo.tc_trans_pelayanan.no_kui_gabung, dbo.tc_trans_pelayanan.kode_tarif_mcu, dbo.tc_trans_pelayanan.lain_lain_jatah, 
                      dbo.tc_trans_pelayanan.lain_lain_selisih, dbo.tc_trans_pelayanan.persen_bpjs, dbo.tc_trans_pelayanan.npp, dbo.tc_trans_pelayanan.bill_rs_p, 
                      dbo.tc_trans_pelayanan.bill_dr_p, dbo.tc_trans_pelayanan.flag_hutang, dbo.tc_trans_pelayanan.status_invoice, dbo.tc_trans_pelayanan.no_urut, 
                      dbo.tc_trans_pelayanan.flag_obat, dbo.tc_trans_pelayanan.jml_konversi, dbo.tc_trans_pelayanan.flag_dr_lab, 
                      dbo.tc_trans_pelayanan.flag_dr_lab_perujuk, dbo.tc_trans_pelayanan.kd_his
FROM         dbo.tc_obat_ruangan INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_obat_ruangan.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_obat_ruangan_v]");
    }
};
