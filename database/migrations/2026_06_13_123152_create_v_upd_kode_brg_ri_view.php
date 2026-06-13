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
        DB::statement("CREATE VIEW dbo.v_upd_kode_brg_ri
AS
SELECT     no_urut, acc_no, tx_nominal, tx_tgl, tx_jam, tx_tipe, no_jurnal, no_det_jurnal, no_bukti, kode_bagian, no_induk, kel_jurnal, no_mr, no_registrasi, kode_perusahaan, 
                      kode_tc_trans_kasir, kode_supplier, kode_dr, kode_barang, kode_bank, referensi, flag_k, flag_posting, kd_trans_bendahara, kd_group_trans, flag_realisasi, 
                      jumlah_barang, flag_rekon, user_rekon, id_rekon, flag_balik_rj, kode_rekon, tgl_bank, id_pajak, flag_pajak, flag_b, flag_cogs, tx_uraian, SUBSTRING(tx_uraian, 44, 8) 
                      AS kd_brg, SUBSTRING(tx_uraian, 53, 2) AS jml_brg
FROM         dbo.tx_harian
WHERE     (kel_jurnal = 2) AND (acc_no = 3150101) AND (tx_uraian LIKE '%farmasi%') AND (no_urut NOT IN (1391573, 1391599, 1391635, 1391746, 1391803, 1391883, 1391995, 
                      1391297))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_upd_kode_brg_ri]");
    }
};
