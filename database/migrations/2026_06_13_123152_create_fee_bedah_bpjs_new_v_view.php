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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_bedah_bpjs_new_v
AS
SELECT        TOP (100) PERCENT a.kode_trans_pelayanan, a.kode_tc_trans_kasir, a.no_kunjungan, a.no_registrasi, a.no_mr, a.kode_kelompok, a.kode_perusahaan, 
                         a.tgl_transaksi, a.jenis_tindakan, a.nama_tindakan, a.bill_rs, a.bill_dr1, a.bill_dr2, a.bill_dr3, 
                         dbo.mt_plafon_dokter_det.persen / 100 * dbo.tc_registrasi.plafon_bpjs AS fee, a.lain_lain, a.kode_dokter1, a.kode_dokter2, a.kode_dokter3, a.jumlah, a.kode_barang, 
                         a.kode_master_tarif_detail, a.kode_master_tarif_detail_jatah, a.kd_tr_resep, a.kode_trans_far, a.kode_tarif, a.kode_bagian, a.kode_bagian_asal, a.kode_klas, 
                         a.no_kamar, a.no_bed, a.kode_penunjang, a.kode_profit, a.status_selesai, a.status_nk, a.status_kredit, a.bill_rs_rujukan, a.bill_rs_laba_rujukan, a.id_dd_rujuk_rs, 
                         a.kamar_tindakan, a.biaya_lain, a.obat, a.alkes, a.alat_rs, a.adm, a.overhead, a.bhp, a.pendapatan_rs, a.flag_jurnal, a.flag_jurnal_pdp, a.obat_cover_persh, 
                         a.tgl_ver, a.bill_rs_selisih, a.bill_dr1_selisih, a.bill_dr2_selisih, a.diskon_rs, a.diskon_dr1, a.diskon_dr2, a.diskon_rs_jatah, a.diskon_dr1_jatah, a.diskon_dr2_jatah,
                          a.diskon_rs_selisih, a.diskon_dr1_selisih, a.diskon_dr2_selisih, a.id_bedah, a.harga_beli, a.flag_tarik, a.paket_sectio, a.tgl_pindah, a.status_batal, a.flag_dr1, 
                         a.flag_dr2, a.no_kui_gabung, a.kode_tarif_mcu, a.lain_lain_jatah, a.lain_lain_selisih, a.persen_bpjs, a.npp, a.bill_rs_p, a.bill_dr_p, a.flag_hutang, a.status_invoice, 
                         a.no_urut, a.flag_obat, a.jml_konversi, a.flag_dr_lab, a.flag_dr_lab_perujuk, a.kd_his, a.flag_amprah, a.id_tc_permintaan_inst, a.profit_2_persen, 
                         a.perawat_ambulan, a.no_radio, a.ref_bedah, a.cito, a.kode_ri, a.id_bd_tc_hutang_dr, a.no_sppu_dr, a.user_batal, a.alasan_batal, a.tgl_update, a.user_update, 
                         a.user_input, a.dr_kirim_fis, a.no_bedah, a.no_reg_resep, a.kode_inap, a.kode_paramedis, a.kode_ruangan, a.flag_param1, a.kode_paramedis2, 
                         a.kode_paramedis3, a.flag_param2, a.flag_param3, a.flag_penata, a.bill_rs_asli, a.bill_dr1_asli, a.bill_dr2_asli, a.jatah_klas, b.seri_kuitansi, b.tgl_jam, 
                         dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.no_jaminan, b.no_kuitansi, dbo.tc_registrasi.noSep, dbo.mt_plafon_dokter_det.persen, 
                         mt_master_tarif_1.referensi
FROM            dbo.mt_master_tarif AS mt_master_tarif_1 INNER JOIN
                         dbo.mt_master_tarif ON mt_master_tarif_1.kode_tarif = dbo.mt_master_tarif.referensi INNER JOIN
                         dbo.mt_plafon_dokter_det ON mt_master_tarif_1.referensi = dbo.mt_plafon_dokter_det.katagori INNER JOIN
                         dbo.tc_trans_pelayanan AS a INNER JOIN
                         dbo.tc_trans_kasir AS b ON b.kode_tc_trans_kasir = a.kode_tc_trans_kasir ON dbo.mt_master_tarif.kode_tarif = a.kode_tarif AND 
                         dbo.mt_plafon_dokter_det.no_urut = a.no_urut RIGHT OUTER JOIN
                         dbo.tc_registrasi ON b.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE        (a.bill_dr1 > 0) AND (a.kode_tc_trans_kasir > 0) AND (a.flag_dr1 IS NULL) AND (b.seri_kuitansi IN ('RI', 'AI')) AND (a.status_batal IS NULL) AND 
                         (NOT (a.kode_kelompok IN (1, 3, 5))) AND (a.kode_bagian IN ('030901', '030501'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_bedah_bpjs_new_v]");
    }
};
