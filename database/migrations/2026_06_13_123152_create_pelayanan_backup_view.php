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
        DB::statement("CREATE VIEW dbo.pelayanan_backup
AS
SELECT     kode_trans_pelayanan, kode_tc_trans_kasir, no_kunjungan, no_registrasi, no_mr, nama_pasien_layan, kode_kelompok, kode_perusahaan, tgl_transaksi, jenis_tindakan, nama_tindakan, bill_rs, 
                      bill_dr1, bill_dr2, bill_dr3, bill_rs_askes, bill_dr1_askes, bill_dr2_askes, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, lain_lain, kode_dokter1, kode_dokter2, kode_dokter3, jumlah, kode_barang, 
                      kode_master_tarif_detail, kode_master_tarif_detail_jatah, kd_tr_resep, kode_trans_far, kode_tarif, kode_bagian, kode_bagian_asal, kode_klas, no_kamar, no_bed, kode_penunjang, kode_profit, 
                      status_selesai, status_nk, status_kredit, bill_rs_rujukan, bill_rs_laba_rujukan, id_dd_rujuk_rs, kamar_tindakan, biaya_lain, obat, alkes, alat_rs, adm, overhead, bhp, pendapatan_rs, flag_jurnal, 
                      flag_jurnal_pdp, obat_cover_persh, tgl_ver, bill_rs_selisih, bill_dr1_selisih, bill_dr2_selisih, diskon_rs, diskon_dr1, diskon_dr2, diskon_rs_jatah, diskon_dr1_jatah, diskon_dr2_jatah, 
                      diskon_rs_selisih, diskon_dr1_selisih, diskon_dr2_selisih, id_bedah, harga_beli, flag_tarik, paket_sectio, tgl_pindah, status_batal, flag_dr1, flag_dr2, no_kui_gabung, kode_tarif_mcu, 
                      lain_lain_jatah, lain_lain_selisih, persen_bpjs, npp, bill_rs_p, bill_dr_p, flag_hutang, status_invoice, no_urut, flag_obat, jml_konversi, flag_dr_lab, flag_dr_lab_perujuk, kd_his, flag_amprah, 
                      id_tc_permintaan_inst, profit_2_persen, perawat_ambulan, no_radio, ref_bedah, cito, kode_ri, id_bd_tc_hutang_dr, no_sppu_dr, user_batal, alasan_batal, tgl_update
FROM         DB_BACK.dbo.tc_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pelayanan_backup]");
    }
};
