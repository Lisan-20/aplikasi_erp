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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kunjungan_srv_back_v
AS
SELECT     id_tc_kunjungan, id_tc_kunjungan2, no_kunjungan, no_registrasi, no_mr, kode_dokter, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, 
                      keterangan, status_batal, flag_um, kode_tc_trans_kasir, tgl_blpl, tgl_pulang, flag_icd, user_pulang, status_blpl, flag_fisio, user_batal, kode_bagian_batal, flag_titipan, status_triase, tgl_kontrol, 
                      flag_wa, flag_serah, tgl_serah, no_induk, ttd_resum, tgl_jam_ttd, nama_wali_resum
FROM         OPENQUERY(SVR_BACK, 'select * from tc_kunjungan') AS derivedtbl_1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_srv_back_v]");
    }
};
