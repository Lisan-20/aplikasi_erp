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
        DB::statement("CREATE OR ALTER VIEW dbo.T_piutang_perusahaan_v
AS
SELECT        dbo.tx_harian.no_urut, dbo.tx_harian.acc_no, dbo.tx_harian.tx_nominal, dbo.tx_harian.tx_uraian, dbo.tx_harian.tx_tgl, dbo.tx_harian.tx_jam, dbo.tx_harian.tx_tipe, 
                         dbo.tx_harian.no_jurnal, dbo.tx_harian.no_det_jurnal, dbo.tx_harian.no_bukti, dbo.tx_harian.kode_bagian, dbo.tx_harian.no_induk, dbo.tx_harian.kel_jurnal, 
                         dbo.tx_harian.no_mr, dbo.tx_harian.no_registrasi, dbo.tx_harian.kode_perusahaan, dbo.tx_harian.kode_tc_trans_kasir, dbo.tx_harian.kode_supplier, 
                         dbo.tx_harian.kode_dr_int, dbo.tx_harian.kode_barang, dbo.tx_harian.kode_bank, dbo.tx_harian.referensi, dbo.tx_harian.flag_k, dbo.tx_harian.flag_posting, 
                         dbo.tx_harian.kd_trans_bendahara, dbo.tx_harian.kd_group_trans, dbo.tx_harian.flag_realisasi, dbo.tx_harian.jumlah_barang, dbo.tx_harian.flag_rekon, 
                         dbo.tx_harian.user_rekon, dbo.tx_harian.id_rekon, dbo.tx_harian.flag_balik_rj, dbo.tx_harian.kode_rekon, dbo.tx_harian.tgl_bank, dbo.tx_harian.id_pajak, 
                         dbo.tx_harian.flag_pajak, dbo.tx_harian.flag_b, dbo.tx_harian.flag_cogs, dbo.tx_harian.tgl_tempo, dbo.tx_harian.kode_trans_far, dbo.tx_harian.kd_tr_resep, 
                         dbo.tx_harian.ko_wil, dbo.tx_harian.tgl_srt_piutang, dbo.tx_harian.kode_ri, dbo.tx_harian.kode_inap, dbo.tx_harian.kode_dr, dbo.tc_tagih.tgl_jt_tempo
FROM            dbo.tx_harian INNER JOIN
                         dbo.mt_perusahaan ON dbo.tx_harian.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan INNER JOIN
                         dbo.tc_tagih ON dbo.tx_harian.no_bukti = dbo.tc_tagih.no_invoice_tagih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [T_piutang_perusahaan_v]");
    }
};
