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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_tc_2far_v
AS
SELECT     derivedtbl_1.no_far, derivedtbl_1.kode_trans_far, derivedtbl_1.kode_pesan_resep, derivedtbl_1.kode_form_ri, derivedtbl_1.kode_form_rj, derivedtbl_1.kode_form_rl, derivedtbl_1.kode_form_bb, 
                      derivedtbl_1.no_resep, derivedtbl_1.kode_profit, derivedtbl_1.kode_bagian, derivedtbl_1.tgl_trans, derivedtbl_1.kode_bagian_asal, derivedtbl_1.no_mr, derivedtbl_1.no_registrasi, 
                      derivedtbl_1.no_kunjungan, derivedtbl_1.kode_dokter, derivedtbl_1.dokter_pengirim, derivedtbl_1.nama_pasien, derivedtbl_1.alamat_pasien, derivedtbl_1.telpon_pasien, 
                      derivedtbl_1.status_transaksi, derivedtbl_1.petugas, derivedtbl_1.npp, derivedtbl_1.kode_form_baksos, derivedtbl_1.flag_serah, derivedtbl_1.tgl_serah, derivedtbl_1.user_serah, 
                      derivedtbl_1.kode_klas, derivedtbl_1.penerima, derivedtbl_1.flag_resep, derivedtbl_1.online, derivedtbl_1.konfirmasi, derivedtbl_1.stat_dr, derivedtbl_1.no_reg_resep, derivedtbl_1.flag_selesai, 
                      derivedtbl_1.user_selesai, derivedtbl_1.tgl_selesai, derivedtbl_1.ttd_serah, derivedtbl_1.kode_trans_far_lama, derivedtbl_1.kode_paket, derivedtbl_1.flag_obt_plang, 
                      dbo.fr_tc_2far.kode_trans_far AS Expr1
FROM         OPENQUERY(SVR_BACK, 'select * from fr_tc_far') AS derivedtbl_1 LEFT OUTER JOIN
                      dbo.fr_tc_2far ON derivedtbl_1.kode_trans_far = dbo.fr_tc_2far.kode_trans_far
WHERE     (dbo.fr_tc_2far.kode_trans_far IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_2far_v]");
    }
};
