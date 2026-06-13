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
        DB::unprepared("
create PROCEDURE [dbo].[batal_gd_tc_gawat_darurat_sp]
	

AS
insert into  gd_tc_gawat_darurat_batal(   kode_gd, no_kunjungan, kode_penyakit, jns_celaka, tanggal_gd, tgl_kecelakaan, tmpt_kecelakaan, dibawa_oleh, bentuk_pelayanan, pemberitahuan_ke, oleh, lapdr_keadaan, pengobatan, 
                      riwayat_singkat, diagnosa_masuk, instruk_penyakit, tgl_jam_msk, tgl_jam_kel, doa, kd_tind_igd, no_induk, tek_darah, instr_lanj, instr_pend, asal_pasien, dikirim_oleh, dibawa_dgn, kasus_polisi, 
                      dokter_jaga, nama_org_dekat, telp_org_dekat, riwayat_kejadian, alamat_org_dekat, status_diterima, kode_klas, kode_bagian, flag_man, status_periksa


)
 select  kode_gd, no_kunjungan, kode_penyakit, jns_celaka, tanggal_gd, tgl_kecelakaan, tmpt_kecelakaan, dibawa_oleh, bentuk_pelayanan, pemberitahuan_ke, oleh, lapdr_keadaan, pengobatan, 
                      riwayat_singkat, diagnosa_masuk, instruk_penyakit, tgl_jam_msk, tgl_jam_kel, doa, kd_tind_igd, no_induk, tek_darah, instr_lanj, instr_pend, asal_pasien, dikirim_oleh, dibawa_dgn, kasus_polisi, 
                      dokter_jaga, nama_org_dekat, telp_org_dekat, riwayat_kejadian, alamat_org_dekat, status_diterima, kode_klas, kode_bagian, flag_man, status_periksa

 
 from batal_gd_tc_gawat_darurat_v


 ---- Hapus tc_registrasi
 delete gd_tc_gawat_darurat where kode_gd in (select kode_gd from gd_tc_gawat_darurat_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_gd_tc_gawat_darurat_sp");
    }
};
