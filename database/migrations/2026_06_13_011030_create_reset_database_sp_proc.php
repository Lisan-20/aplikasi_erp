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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[reset_database_sp]

as

truncate 	table	tc_permohonan_cash_det_gizi_new
truncate 	table	tc_potongan
truncate 	table	tc_permohonan_nm
truncate 	table	tc_trans_kartu
truncate 	table	tc_po_nm
truncate 	table	tc_bayar_tagih
truncate 	table	tc_trans_pelayanan
truncate 	table	tc_riwayat_edit_barang
truncate 	table	tc_referensi_nm
truncate 	table	tc_referensi_nm_det
truncate 	table	tc_rekam_medis
truncate 	table	tc_tagih_det
truncate 	table	tc_penerimaan_rekanan
truncate 	table	tc_penerimaan_rekanan_detail
truncate 	table	tc_bayar_tagih_det
truncate 	table	tc_penerimaan_barang
truncate 	table	tc_stok_opname_nm
truncate 	table	tc_stok_opname
truncate 	table	tc_riwayat_status
truncate 	table	tc_kartu_stok
truncate 	table	tc_fee_dokter
truncate 	table	tc_chatting
truncate 	table	tc_bayar_dr
truncate 	table	tc_trans_kasir_bak
truncate 	table	tc_insentif
truncate 	table	tc_penerimaan_barang_nm
truncate 	table	tc_trans_kasir
truncate 	table	tc_chatting_reply
truncate 	table	tc_sensus_gizi
truncate 	table	tc_bayar_pajak_dr
truncate 	table	tc_tindakan_ranap_det
truncate 	table	tc_kuitansi_gabung
truncate 	table	tc_pemakaian_brg_nm
truncate 	table	tc_hutang_dr
truncate 	table	tc_setoran
truncate 	table	tc_trans_jkn
truncate 	table	tc_cuti
truncate 	table	tc_diskon_khusus
truncate 	table	tc_pemesanan_gizi
truncate 	table	tc_pemesanan_gizi_det
truncate 	table	tc_pem2fisik
truncate 	table	tc_penerimaan_gizi
truncate 	table	tc_pem2fisik_det
truncate 	table	tc_kartu_hutang
truncate 	table	tc_pemeriksaangigi
truncate 	table	tc_lembur
truncate 	table	tc_transaksi_payroll
truncate 	table	tc_pemeriksaangigi_det
truncate 	table	tc_penerimaan_gizi_detail
truncate 	table	tc_referensi
truncate 	table	tc_penempatan
truncate 	table	tc_referensi_det
truncate 	table	tc_permohonan_gizi
truncate 	table	tc_jasa
truncate 	table	tc_permohonan_gizi_det
truncate 	table	tc_gaji_tiap_bulan
truncate 	table	tc_permohonan_cash_atk
truncate 	table	tc_permohonan_cash_det_atk
truncate 	table	tc_hukuman
truncate 	table	tc_stok_opname_temp
truncate 	table	tc_keahlian
truncate 	table	tc_pendaftaran_masal
truncate 	table	tc_pendaftaran
truncate 	table	tc_antrian_loket
truncate 	table	tc_obat_ruangan
truncate 	table	tc_bedah
truncate 	table	tc_permohonan
truncate 	table	tc_permohonan_det
truncate 	table	tc_baksos
truncate 	table	tc_permintaan_rekanan_det
truncate 	table	tc_resep_dokter
truncate 	table	tc_permintaan_inst_nm
truncate 	table	tc_permintaan_inst_nm_det
truncate 	table	tc_pngeambilan_brg_gizi
truncate 	table	tc_bayar_piutang_manual
truncate 	table	tc_pengambilan_brg_gizi_det
truncate 	table	tc_po
truncate 	table	tc_penerimaan_inst
truncate 	table	tc_pengambilan_brg_gizi
truncate 	table	tc_permintaan_inst
truncate 	table	tc_permintaan_inst_det
truncate 	table	tc_bpako_hemodialisa
truncate 	table	tc_dpjp_rinap
truncate 	table	tc_diskon_showa
truncate 	table	tc_depo_stok_asset
truncate 	table	tc_fee_dokter_bpjs
truncate 	table	tc_po_det
truncate 	table	tc_hutang_rujukan_inv
truncate 	table	tc_kartu_stokcito
truncate 	table	tc_permohonan_nm_det_oke
truncate 	table	tc_hutang_rujukan_vcr
truncate 	table	tc_paket_ok
truncate 	table	tc_kartu_stokbebas
truncate 	table	tc_permohonan_nm_import
truncate 	table	tc_publik_sharing
truncate 	table	tc_hutang_rujukan_vcr_det
truncate 	table	tc_trans_gudang
--truncate 	table	tc_permohonan_nm_det_lama
truncate 	table	tc_pengadaan
truncate 	table	tc_pembayaran
truncate 	table	tc_permohonan_nm_det
truncate 	table	tc_detail_penerimaan_barang
truncate 	table	tc_registrasi
truncate 	table	tc_permintaan_instalasi
truncate 	table	tc_po_nm_det
truncate 	table	tc_permintaan_instalasi_detail
truncate 	table	tc_penerimaan_barang_detail
truncate 	table	tc_anggaran_biaya
truncate 	table	tc_permohonan_detail
truncate 	table	tc_permohonan_revisi
truncate 	table	tc_oksigen
truncate 	table	tc_kunjungan
truncate 	table	tc_p3k
truncate 	table	tc_biaya_op
truncate 	table	tc_detail_po
truncate 	table	tc_slip_sppu_dokter
truncate 	table	tc_penerimaan_instalasi_detail
truncate 	table	tc_permohonan_cash_gizi
truncate 	table	tc_permohonan_cash_det_gizi
truncate 	table	tc_jatah_cuti
truncate 	table	tc_jatah_lembur
truncate 	table	tc_bpako_paketSC
truncate 	table	tc_absensi
truncate 	table	tc_fee_dokter_man
truncate 	table	tc_penilaian_kinerja
truncate 	table	tc_surat_izin
truncate 	table	tc_penilaian_kinerja_det
truncate 	table	tc_permohonan_cash
truncate 	table	tc_penerimaan_barang_nm_detail_temp
truncate 	table	tc_permohonan_cash_det
truncate 	table	tc_tagih
truncate 	table	tc_permintaan_inst_det_temp
truncate 	table	tc_trans_kasir_bagian
truncate 	table	tc_retur_supplier
truncate 	table	tc_penerimaan_barang_nm_detail
truncate 	table	tc_kunjungan_tarik
truncate 	table	tc_penerimaan_retur
truncate 	table	tc_hutang_supplier_inv
truncate 	table	tc_kartu_stok_brg_jasa
truncate 	table	tc_hutang_supplier_vcr
truncate 	table	tc_tindakan_TC
truncate 	table	tc_retur_unit
truncate 	table	tc_pesanan
truncate 	table	tc_hutang_supplier_vcr_det
truncate 	table	tc_rekam_medik
truncate 	table	tc_kartu_piutang
truncate 	table	tc_gaji_pokok
truncate 	table	tc_penerimaan_barang_detail_temp
truncate 	table	tc_tunjangan
truncate 	table	tc_permintaan_rekanan
truncate 	table	tc_retur_unit_det
truncate 	table	th_icd10_pasien
truncate 	table	th_riwayat_pasien
truncate 	table	th_permohonan_nm
truncate 	table	th_permohonan_nm_det
truncate 	table	th_catatan_khusus_pasien
truncate 	table	th_icd9_pasien
truncate 	table	th_permohonan
truncate 	table	th_permohonan_det
truncate 	table	th_permintaan_instalasi
--truncate 	table	th_riwayat_pasien_sytem_lama
truncate 	table	th_permohonan_cash
truncate 	table	th_permohonan_cash_det
truncate 	table	th_penerimaan_barang_det
truncate 	table	ri_tc_rawatinap_det
truncate 	table	fr_tc_far_detail
truncate 	table	pm_tc_penunjang
truncate 	table	fr_tc_far_his
truncate 	table	gd_tc_gawat_darurat
truncate 	table	pl_tc_poli
truncate 	table	pm_tc_obalkes
truncate 	table	pm_tc_hasilpenunjang
truncate 	table	bd_tc_trans_detail
truncate 	table	bd_tc_trans
truncate 	table	ri_tc_riwayat_kelas
truncate 	table	ks_tc_trans_um
truncate 	table	fr_tc_far
truncate 	table	gd_tc_cetak_racun
truncate 	table	gd_fr_tc_gudang
truncate 	table	gd_fr_tc_gudang_detail
truncate 	table	bd_tc_bayar_dr
truncate 	table	gd_tc_status_harian
truncate 	table	bd_tc_bayar_pajak_dr
truncate 	table	bd_tc_hutang_dr
truncate 	table	bd_tc_setoran
truncate 	table	bd_tc_trans_flag_dr
truncate 	table	gd_tc_cetak_visum
truncate 	table	ri_tc_rawatinap
truncate 	table	rg_tc_rujukan
--truncate 	table	mt_jenis_TC
truncate 	table	fr_tc_pesan_resep
--truncate 	table	mt_jenis_TC_det
--truncate 	table	mt_jenis_tc_det_tarif
truncate 	table	transaksi_hutang_khusus
truncate 	table	transaksi_piutang_khusus
truncate 	table	transaksi
truncate 	table	transaksi_detail
truncate 	table	transaksi_umd
truncate 	table	transaksi_pj_umd
truncate 	table	transaksi_hutang
truncate 	table	transaksi_hutang_detail
truncate 	table	transaksi_umd_gudang
truncate 	table	transaksi_piutang_bayar
truncate 	table	transaksi_piutang
truncate 	table	transaksi_sppu
truncate 	table   transaksi_umd_detail
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS reset_database_sp");
    }
};
