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
CREATE PROCEDURE [dbo].[batal_tc_registrasi_sp]
	

AS
insert into  tc_registrasi_batal(id_tc_registrasi, no_registrasi, no_mr, kode_perusahaan, kode_kelompok, kode_dokter, no_induk, tgl_jam_masuk, tgl_jam_keluar, prioritas, kode_bagian_masuk, kode_bagian_keluar, 
                      status_batal, stat_pasien, status_registrasi, umur_old, tgl_input, id_paket, no_jaminan, nik, kode_pt, nama_pt, status_man, no_jkn, no_skp, plafon_bpjs, diagnosa, kode_plafon, byr_selisih, 
                      flag_daftar, st_daftar_ulang, status_milik, kode_penanggung, umur, id_dc_asal_pasien, flag_dr_fis_perujuk, nama_karyawan, flag_status, noKartuPeserta, tglSep, tglRujukan, noRujukan, 
                      ppkRujukan, ppkPelayanan, jnsPelayanan, catatan, kdDiag, diagAwal, poliTujuan, klsRawat, userInp, noMr, noSep, milike, jnsPeserta, code, id_dc_sub_asal_pasien, ket_batal, flag_p2d, memo, 
                      tgl_update, user_update, flag_pending, flag_pending_bpjs, jasa_kiriman, no_sjp, user_trma_p2d, no_urut, stat_celaka, flag_jurnal, flag_coding_inacbg, daftar_ol, flag_verif, user_verif, alasan_batal,
                       tgl_jam_batal, kode_booking, no_antrian_jkn, flag_checkin, tgl_checkin, nmRujukan, respon_addantrian, flag_prolanis, provPerujuk, prolanisPRB, hakKelas, flag_kirim, no_reg_inap, flag_wa, ttd, 
                      st_fisik, st_kebiasaan, saran, status_kes, id_resum, tgl_hadir, st_riwayat, st_lab, st_rad, st_ekg, st_aud, st_spiro, flag_kirim_th, kelengkapan_pas, st_ass_awal, tgl_jam_ass_awal, 
                      id_user_perawat, st_ass_awal_lanjutan, tgl_jam_ass_awal_lanjutan, st_ass_dr, tgl_jam_ass_awal_dr, st_ass_dr_lanjutan, tgl_jam_ass_awal_dr_lanjut, st_ass_dr_gigi, st_ass_dr_gigi_lanjutan, 
                      st_ass_perawat_ANC, id_user_perawat_ANC, st_ass_perawat_PNC, tgl_jam_ass_perawat_PNC, id_user_perawat_PNC, tgl_jam_ass_perawat_ANC, st_dr_anc, tgl_jam_dr_anc, st_dr_pnc, 
                      tgl_jam_dr_pnc, flag_skd, flag_skb, flag_skk, ft_coding2, ft_pengantar, ft_sep, flag_info, flag_skh, flag_sch, info_1, info_2, st_ass_dr_igd, tgl_jam_dr_igd, st_ass_awal_fisio, tgl_jam_fisio, 
                      id_user_fisio, st_ass_inv_fisio, tgl_jam_inv_fisio, id_user_inv_fisio, st_ass_awal_hemo, tgl_jam_hemo, id_user_hemo, st_ass_inv_hemo, tgl_jam_inv_hemo, id_user_inv_hemo, 
                      st_ass_plk_hemo, tgl_jam_plk_hemo, id_user_plk_hemo, st_usg, ttd_setuju_inap, nama_ttd_inap, tgl_ttd, id_triase_identitas, st_kll, st_serah_terima, st_rujuk, nama_wali, alamat_wali, no_tlp_wali, 
                      hubungan_wali, privasi_1, privasi_2, Umum_ri, Khusus_ri, Bedah_ri, flag_sk_pasien, ttd_sk_pasien, tgl_sk_pasien, ttd_ri, flag_rj_ext, flag_rj_int, ft_coding, st_ass_luar, st_ass_dis, flag_tolak_ri, 
                      tgl_tolak_ri, ttd_sk_tolak, nama_kel_ter, nama_almt_kel, tlp_kel, hubungan_kel, umur_wali, jen_kel_wali, al_penolakan_ri, id_petugas, saksi_1, ttd_saksi_1, saksi_2, ttd_saksi_2, flag_dr, tgl_verif, 
                      st_ass_ogbyn, flag_ver_erm, jeniskunjungan

)
 select id_tc_registrasi, no_registrasi, no_mr, kode_perusahaan, kode_kelompok, kode_dokter, no_induk, tgl_jam_masuk, tgl_jam_keluar, prioritas, kode_bagian_masuk, kode_bagian_keluar, 
                      status_batal, stat_pasien, status_registrasi, umur_old, tgl_input, id_paket, no_jaminan, nik, kode_pt, nama_pt, status_man, no_jkn, no_skp, plafon_bpjs, diagnosa, kode_plafon, byr_selisih, 
                      flag_daftar, st_daftar_ulang, status_milik, kode_penanggung, umur, id_dc_asal_pasien, flag_dr_fis_perujuk, nama_karyawan, flag_status, noKartuPeserta, tglSep, tglRujukan, noRujukan, 
                      ppkRujukan, ppkPelayanan, jnsPelayanan, catatan, kdDiag, diagAwal, poliTujuan, klsRawat, userInp, noMr, noSep, milike, jnsPeserta, code, id_dc_sub_asal_pasien, ket_batal, flag_p2d, memo, 
                      tgl_update, user_update, flag_pending, flag_pending_bpjs, jasa_kiriman, no_sjp, user_trma_p2d, no_urut, stat_celaka, flag_jurnal, flag_coding_inacbg, daftar_ol, flag_verif, user_verif, alasan_batal,
                       tgl_jam_batal, kode_booking, no_antrian_jkn, flag_checkin, tgl_checkin, nmRujukan, respon_addantrian, flag_prolanis, provPerujuk, prolanisPRB, hakKelas, flag_kirim, no_reg_inap, flag_wa, ttd, 
                      st_fisik, st_kebiasaan, saran, status_kes, id_resum, tgl_hadir, st_riwayat, st_lab, st_rad, st_ekg, st_aud, st_spiro, flag_kirim_th, kelengkapan_pas, st_ass_awal, tgl_jam_ass_awal, 
                      id_user_perawat, st_ass_awal_lanjutan, tgl_jam_ass_awal_lanjutan, st_ass_dr, tgl_jam_ass_awal_dr, st_ass_dr_lanjutan, tgl_jam_ass_awal_dr_lanjut, st_ass_dr_gigi, st_ass_dr_gigi_lanjutan, 
                      st_ass_perawat_ANC, id_user_perawat_ANC, st_ass_perawat_PNC, tgl_jam_ass_perawat_PNC, id_user_perawat_PNC, tgl_jam_ass_perawat_ANC, st_dr_anc, tgl_jam_dr_anc, st_dr_pnc, 
                      tgl_jam_dr_pnc, flag_skd, flag_skb, flag_skk, ft_coding2, ft_pengantar, ft_sep, flag_info, flag_skh, flag_sch, info_1, info_2, st_ass_dr_igd, tgl_jam_dr_igd, st_ass_awal_fisio, tgl_jam_fisio, 
                      id_user_fisio, st_ass_inv_fisio, tgl_jam_inv_fisio, id_user_inv_fisio, st_ass_awal_hemo, tgl_jam_hemo, id_user_hemo, st_ass_inv_hemo, tgl_jam_inv_hemo, id_user_inv_hemo, 
                      st_ass_plk_hemo, tgl_jam_plk_hemo, id_user_plk_hemo, st_usg, ttd_setuju_inap, nama_ttd_inap, tgl_ttd, id_triase_identitas, st_kll, st_serah_terima, st_rujuk, nama_wali, alamat_wali, no_tlp_wali, 
                      hubungan_wali, privasi_1, privasi_2, Umum_ri, Khusus_ri, Bedah_ri, flag_sk_pasien, ttd_sk_pasien, tgl_sk_pasien, ttd_ri, flag_rj_ext, flag_rj_int, ft_coding, st_ass_luar, st_ass_dis, flag_tolak_ri, 
                      tgl_tolak_ri, ttd_sk_tolak, nama_kel_ter, nama_almt_kel, tlp_kel, hubungan_kel, umur_wali, jen_kel_wali, al_penolakan_ri, id_petugas, saksi_1, ttd_saksi_1, saksi_2, ttd_saksi_2, flag_dr, tgl_verif, 
                      st_ass_ogbyn, flag_ver_erm, jeniskunjungan

 
 from batal_tc_registrasi_v


 ---- Hapus tc_registrasi
 delete tc_registrasi where id_tc_registrasi in (select id_tc_registrasi from tc_registrasi_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_tc_registrasi_sp");
    }
};
