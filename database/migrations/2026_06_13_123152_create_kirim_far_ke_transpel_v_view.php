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
        DB::statement("CREATE VIEW dbo.kirim_far_ke_transpel_v
AS
SELECT     TOP (100) PERCENT a.kode_trans_far, a.kode_pesan_resep, a.kode_form_ri, a.kode_form_rj, a.kode_form_rl, a.kode_form_bb, a.no_resep, a.kode_profit, 
                      a.kode_bagian, a.tgl_trans, a.kode_bagian_asal, a.no_mr, a.no_registrasi, a.no_kunjungan, a.kode_dokter, a.dokter_pengirim, a.nama_pasien, a.alamat_pasien, 
                      a.telpon_pasien, a.status_transaksi, a.petugas, a.npp, a.kode_form_baksos, a.flag_serah, a.tgl_serah, a.user_serah, a.kode_klas, a.penerima, b.kd_tr_resep, 
                      b.kode_trans_far AS Expr1, b.jumlah_pesan, b.jumlah_tebus, b.sisa, b.jumlah_retur, b.harga_r_retur, b.kode_brg, b.harga_beli, b.harga_jual, b.harga_r, 
                      b.biaya_tebus, b.bill_rs, b.bill_dr1, b.bill_dr2, b.bill_rs_askes, b.bill_dr1_askes, b.bill_dr2_askes, b.bill_rs_jatah, b.bill_dr1_jatah, b.bill_dr2_jatah, b.status_kirim, 
                      b.status_retur, b.kode_cito, b.racik, b.obat_cover_persh, b.diskon, b.kode_diskon, b.takaran, b.penggunaan, b.instruksi, b.jml_pakai, b.jml_takar, b.jml_konversi, 
                      b.tgl_input, c.nama_brg, b.profit_2_persen, a.no_reg_resep
FROM         dbo.fr_tc_far AS a INNER JOIN
                      dbo.fr_tc_far_detail AS b ON a.kode_trans_far = b.kode_trans_far INNER JOIN
                      dbo.mt_barang AS c ON b.kode_brg = c.kode_brg
WHERE     (a.status_transaksi IS NULL) OR
                      (a.status_transaksi = 0)
ORDER BY b.kd_tr_resep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kirim_far_ke_transpel_v]");
    }
};
