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
        DB::statement("CREATE VIEW dbo.farmasi_dokter_v
AS
SELECT        dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.kode_form_ri, dbo.fr_tc_far.kode_form_rj, dbo.fr_tc_far.kode_form_rl, dbo.fr_tc_far.kode_form_bb, dbo.fr_tc_far.no_resep, 
                         dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.kode_dokter, 
                         dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.alamat_pasien, dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.petugas, dbo.fr_tc_far.npp, 
                         dbo.fr_tc_far.kode_form_baksos, dbo.fr_tc_far.flag_serah, dbo.fr_tc_far.tgl_serah, dbo.fr_tc_far.user_serah, dbo.fr_tc_far.kode_klas, dbo.fr_tc_far.penerima, dbo.fr_tc_far.flag_resep, dbo.fr_tc_far.online, 
                         dbo.fr_tc_far.konfirmasi, dbo.fr_tc_far_detail.kd_tr_resep, dbo.fr_tc_far_detail.kode_trans_far AS Expr1, dbo.fr_tc_far_detail.jumlah_pesan, dbo.fr_tc_far_detail.jumlah_tebus, dbo.fr_tc_far_detail.sisa, 
                         dbo.fr_tc_far_detail.jumlah_retur, dbo.fr_tc_far_detail.harga_r_retur, dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far_detail.harga_beli, dbo.fr_tc_far_detail.harga_jual, dbo.fr_tc_far_detail.harga_r, 
                         dbo.fr_tc_far_detail.biaya_tebus, dbo.fr_tc_far_detail.bill_rs, dbo.fr_tc_far_detail.bill_dr1, dbo.fr_tc_far_detail.bill_dr2, dbo.fr_tc_far_detail.bill_rs_askes, dbo.fr_tc_far_detail.bill_dr1_askes, 
                         dbo.fr_tc_far_detail.bill_dr2_askes, dbo.fr_tc_far_detail.bill_rs_jatah, dbo.fr_tc_far_detail.bill_dr1_jatah, dbo.fr_tc_far_detail.bill_dr2_jatah, dbo.fr_tc_far_detail.status_kirim, dbo.fr_tc_far_detail.status_retur, 
                         dbo.fr_tc_far_detail.kode_cito, dbo.fr_tc_far_detail.racik, dbo.fr_tc_far_detail.obat_cover_persh, dbo.fr_tc_far_detail.diskon, dbo.fr_tc_far_detail.kode_diskon, dbo.fr_tc_far_detail.takaran, 
                         dbo.fr_tc_far_detail.penggunaan, dbo.fr_tc_far_detail.instruksi, dbo.fr_tc_far_detail.jml_pakai, dbo.fr_tc_far_detail.jml_takar, dbo.fr_tc_far_detail.jml_konversi, dbo.fr_tc_far_detail.tgl_input, 
                         dbo.fr_tc_far_detail.alasan_retur, dbo.fr_tc_far_detail.profit_2_persen, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil
FROM            dbo.fr_tc_far INNER JOIN
                         dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                         dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [farmasi_dokter_v]");
    }
};
