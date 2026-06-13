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
        DB::statement("CREATE VIEW dbo.tagihan_jkn_det_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_kuitansi_bendahara, 
                      dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, 
                      dbo.tc_trans_kasir.potongan, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.nk_karyawan, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.tc_trans_kasir.pembulatan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.keterangan, dbo.tc_trans_kasir.kd_inv_umum_tx, 
                      dbo.tc_trans_kasir.kd_inv_askes, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.kd_inv_kary_tx, dbo.tc_trans_kasir.flag_jurnal, dbo.tc_trans_kasir.tgl_ver, 
                      dbo.tc_trans_kasir.user_ver, dbo.tc_trans_kasir.kd_inv_cc_tx, dbo.tc_trans_kasir.kd_inv_dc_tx, dbo.tc_trans_kasir.materai, dbo.tc_trans_kasir.kode_bagian, 
                      dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.no_kui_gabung, dbo.tc_trans_kasir.nk_bpjs, dbo.tc_trans_kasir.plafon, dbo.tc_trans_kasir.rl_bag, 
                      dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.selisih_bpjs, dbo.tc_trans_kasir.kode_penanggung, dbo.tc_trans_kasir.kd_inv_persh_tx_penanggung, 
                      dbo.tc_trans_kasir.flag_tagih_penanggung, dbo.tc_trans_kasir.kode_ri, dbo.tc_registrasi.kode_kelompok, dbo.GROUPER_INACBG_REST.TotalTarif, 
                      dbo.tc_registrasi.flag_pending_bpjs, dbo.GROUPER_INACBG_REST.NoSep
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.GROUPER_INACBG_REST ON dbo.tc_registrasi.noSep = dbo.GROUPER_INACBG_REST.NoSep
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.kode_kelompok IN (9, 8, 11, 10, 12)) AND (dbo.tc_trans_kasir.nk_perusahaan > 0) AND 
                      (dbo.tc_trans_kasir.flag_tagih = 1) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_jkn_det_v]");
    }
};
