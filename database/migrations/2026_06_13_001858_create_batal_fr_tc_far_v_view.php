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
        DB::statement("CREATE OR ALTER VIEW dbo.batal_fr_tc_far_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.kode_form_ri, dbo.fr_tc_far.kode_form_rj, dbo.fr_tc_far.kode_form_rl, dbo.fr_tc_far.kode_form_bb, dbo.fr_tc_far.no_resep, 
                      dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, 
                      dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.alamat_pasien, dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.petugas, 
                      dbo.fr_tc_far.npp, dbo.fr_tc_far.kode_form_baksos, dbo.fr_tc_far.flag_serah, dbo.fr_tc_far.tgl_serah, dbo.fr_tc_far.user_serah, dbo.fr_tc_far.kode_klas, dbo.fr_tc_far.penerima, 
                      dbo.fr_tc_far.flag_resep, dbo.fr_tc_far.online, dbo.fr_tc_far.konfirmasi, dbo.fr_tc_far.stat_dr, dbo.fr_tc_far.no_reg_resep, dbo.fr_tc_far.flag_selesai, dbo.fr_tc_far.user_selesai, 
                      dbo.fr_tc_far.tgl_selesai, dbo.fr_tc_far.ttd_serah, dbo.fr_tc_far.kode_trans_far_lama, dbo.fr_tc_far.kode_paket, dbo.fr_tc_far.kode_resep, dbo.fr_tc_far.tgl_status_transaksi, 
                      dbo.fr_tc_far.id_user_status, dbo.fr_tc_far.flag_obt_plang, dbo.fr_tc_far.flag_perawat, dbo.fr_tc_far_batal.kode_trans_far AS Expr1
FROM         dbo.fr_tc_far LEFT OUTER JOIN
                      dbo.fr_tc_far_batal ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_batal.kode_trans_far
WHERE     (dbo.fr_tc_far.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_registrasi_batal)) AND (dbo.fr_tc_far_batal.kode_trans_far IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_fr_tc_far_v]");
    }
};
