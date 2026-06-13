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
        DB::statement("CREATE VIEW dbo.batal_tc_registrasi_v
AS
SELECT        dbo.tc_registrasi.id_tc_registrasi, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.no_induk, 
                         dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, 
                         dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur_old, dbo.tc_registrasi.tgl_input, dbo.tc_registrasi.id_paket, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.nik, dbo.tc_registrasi.kode_pt, 
                         dbo.tc_registrasi.nama_pt, dbo.tc_registrasi.status_man, dbo.tc_registrasi.no_jkn, dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.kode_plafon, 
                         dbo.tc_registrasi.byr_selisih, dbo.tc_registrasi.flag_daftar, dbo.tc_registrasi.st_daftar_ulang, dbo.tc_registrasi.status_milik, dbo.tc_registrasi.kode_penanggung, dbo.tc_registrasi.umur, dbo.tc_registrasi.id_dc_asal_pasien, 
                         dbo.tc_registrasi.flag_dr_fis_perujuk, dbo.tc_registrasi.nama_karyawan, dbo.tc_registrasi.flag_status, dbo.tc_registrasi.noKartuPeserta, dbo.tc_registrasi.tglSep, dbo.tc_registrasi.tglRujukan, dbo.tc_registrasi.noRujukan, 
                         dbo.tc_registrasi.ppkRujukan, dbo.tc_registrasi.ppkPelayanan, dbo.tc_registrasi.jnsPelayanan, dbo.tc_registrasi.catatan, dbo.tc_registrasi.kdDiag, dbo.tc_registrasi.diagAwal, dbo.tc_registrasi.poliTujuan, 
                         dbo.tc_registrasi.klsRawat, dbo.tc_registrasi.userInp, dbo.tc_registrasi.noMr, dbo.tc_registrasi.noSep, dbo.tc_registrasi.milike, dbo.tc_registrasi.jnsPeserta, dbo.tc_registrasi.code, dbo.tc_registrasi.id_dc_sub_asal_pasien, 
                         dbo.tc_registrasi.ket_batal, dbo.tc_registrasi.flag_p2d, dbo.tc_registrasi.memo, dbo.tc_registrasi.tgl_update, dbo.tc_registrasi.user_update, dbo.tc_registrasi.flag_pending, dbo.tc_registrasi.flag_pending_bpjs, 
                         dbo.tc_registrasi.jasa_kiriman, dbo.tc_registrasi.no_sjp, dbo.tc_registrasi.user_trma_p2d, dbo.tc_registrasi.no_urut, dbo.tc_registrasi.stat_celaka, dbo.tc_registrasi.flag_jurnal, dbo.tc_registrasi.flag_coding_inacbg, 
                         dbo.tc_registrasi.daftar_ol, dbo.tc_registrasi.flag_verif, dbo.tc_registrasi.user_verif, dbo.tc_registrasi.alasan_batal, dbo.tc_registrasi.tgl_jam_batal, dbo.tc_registrasi.kode_booking, dbo.tc_registrasi.no_antrian_jkn, 
                         dbo.tc_registrasi.flag_checkin, dbo.tc_registrasi.tgl_checkin, dbo.tc_registrasi.nmRujukan, dbo.tc_registrasi.respon_addantrian, dbo.tc_registrasi.flag_prolanis, dbo.tc_registrasi.provPerujuk, dbo.tc_registrasi.prolanisPRB, 
                         dbo.tc_registrasi.hakKelas, dbo.tc_registrasi.flag_kirim, dbo.tc_registrasi.no_reg_inap, dbo.tc_registrasi.flag_wa, dbo.tc_registrasi.ttd, dbo.tc_registrasi.st_fisik, dbo.tc_registrasi.st_kebiasaan, dbo.tc_registrasi.saran, 
                         dbo.tc_registrasi.status_kes, dbo.tc_registrasi.id_resum, dbo.tc_registrasi.tgl_hadir, dbo.tc_registrasi.st_riwayat, dbo.tc_registrasi.st_lab, dbo.tc_registrasi.st_rad, dbo.tc_registrasi.st_ekg, dbo.tc_registrasi.st_aud, 
                         dbo.tc_registrasi.st_spiro, dbo.tc_registrasi.flag_kirim_th, dbo.tc_registrasi.kelengkapan_pas, dbo.tc_registrasi.st_ass_awal, dbo.tc_registrasi.tgl_jam_ass_awal, dbo.tc_registrasi.id_user_perawat, 
                         dbo.tc_registrasi.st_ass_awal_lanjutan, dbo.tc_registrasi.tgl_jam_ass_awal_lanjutan, dbo.tc_registrasi.st_ass_dr, dbo.tc_registrasi.tgl_jam_ass_awal_dr, dbo.tc_registrasi.st_ass_dr_lanjutan, 
                         dbo.tc_registrasi.tgl_jam_ass_awal_dr_lanjut, dbo.tc_registrasi.st_ass_dr_gigi, dbo.tc_registrasi.st_ass_dr_gigi_lanjutan, dbo.tc_registrasi.st_ass_perawat_ANC, dbo.tc_registrasi.id_user_perawat_ANC, 
                         dbo.tc_registrasi.st_ass_perawat_PNC, dbo.tc_registrasi.tgl_jam_ass_perawat_PNC, dbo.tc_registrasi.id_user_perawat_PNC, dbo.tc_registrasi.tgl_jam_ass_perawat_ANC, dbo.tc_registrasi.st_dr_anc, 
                         dbo.tc_registrasi.tgl_jam_dr_anc, dbo.tc_registrasi.st_dr_pnc, dbo.tc_registrasi.tgl_jam_dr_pnc, dbo.tc_registrasi.flag_skd, dbo.tc_registrasi.flag_skb, dbo.tc_registrasi.flag_skk, dbo.tc_registrasi.ft_coding2, 
                         dbo.tc_registrasi.ft_pengantar, dbo.tc_registrasi.ft_sep, dbo.tc_registrasi.flag_info, dbo.tc_registrasi.flag_skh, dbo.tc_registrasi.flag_sch, dbo.tc_registrasi.info_1, dbo.tc_registrasi.info_2, dbo.tc_registrasi.st_ass_dr_igd, 
                         dbo.tc_registrasi.tgl_jam_dr_igd, dbo.tc_registrasi.st_ass_awal_fisio, dbo.tc_registrasi.tgl_jam_fisio, dbo.tc_registrasi.id_user_fisio, dbo.tc_registrasi.st_ass_inv_fisio, dbo.tc_registrasi.tgl_jam_inv_fisio, 
                         dbo.tc_registrasi.id_user_inv_fisio, dbo.tc_registrasi.st_ass_awal_hemo, dbo.tc_registrasi.tgl_jam_hemo, dbo.tc_registrasi.id_user_hemo, dbo.tc_registrasi.st_ass_inv_hemo, dbo.tc_registrasi.tgl_jam_inv_hemo, 
                         dbo.tc_registrasi.id_user_inv_hemo, dbo.tc_registrasi.st_ass_plk_hemo, dbo.tc_registrasi.tgl_jam_plk_hemo, dbo.tc_registrasi.id_user_plk_hemo, dbo.tc_registrasi.st_usg, dbo.tc_registrasi.ttd_setuju_inap, 
                         dbo.tc_registrasi.nama_ttd_inap, dbo.tc_registrasi.tgl_ttd, dbo.tc_registrasi.id_triase_identitas, dbo.tc_registrasi.st_kll, dbo.tc_registrasi.st_serah_terima, dbo.tc_registrasi.st_rujuk, dbo.tc_registrasi.nama_wali, 
                         dbo.tc_registrasi.alamat_wali, dbo.tc_registrasi.no_tlp_wali, dbo.tc_registrasi.hubungan_wali, dbo.tc_registrasi.privasi_1, dbo.tc_registrasi.privasi_2, dbo.tc_registrasi.Umum_ri, dbo.tc_registrasi.Khusus_ri, 
                         dbo.tc_registrasi.Bedah_ri, dbo.tc_registrasi.flag_sk_pasien, dbo.tc_registrasi.ttd_sk_pasien, dbo.tc_registrasi.tgl_sk_pasien, dbo.tc_registrasi.ttd_ri, dbo.tc_registrasi.flag_rj_ext, dbo.tc_registrasi.flag_rj_int, 
                         dbo.tc_registrasi.ft_coding, dbo.tc_registrasi.st_ass_luar, dbo.tc_registrasi.st_ass_dis, dbo.tc_registrasi.flag_tolak_ri, dbo.tc_registrasi.tgl_tolak_ri, dbo.tc_registrasi.ttd_sk_tolak, dbo.tc_registrasi.nama_kel_ter, 
                         dbo.tc_registrasi.nama_almt_kel, dbo.tc_registrasi.tlp_kel, dbo.tc_registrasi.hubungan_kel, dbo.tc_registrasi.umur_wali, dbo.tc_registrasi.jen_kel_wali, dbo.tc_registrasi.al_penolakan_ri, dbo.tc_registrasi.id_petugas, 
                         dbo.tc_registrasi.saksi_1, dbo.tc_registrasi.ttd_saksi_1, dbo.tc_registrasi.saksi_2, dbo.tc_registrasi.ttd_saksi_2, dbo.tc_registrasi.flag_dr, dbo.tc_registrasi.tgl_verif, dbo.tc_registrasi.st_ass_ogbyn, 
                         dbo.tc_registrasi.flag_ver_erm, dbo.tc_registrasi.jeniskunjungan, dbo.tc_registrasi_batal.id_tc_registrasi AS Expr1, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS Expr2, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS Expr3
FROM            dbo.tc_registrasi LEFT OUTER JOIN
                         dbo.tc_registrasi_batal ON dbo.tc_registrasi.id_tc_registrasi = dbo.tc_registrasi_batal.id_tc_registrasi
WHERE        (dbo.tc_registrasi.status_batal = 1) AND (dbo.tc_registrasi_batal.id_tc_registrasi IS NULL) AND (YEAR(dbo.tc_registrasi.tgl_jam_masuk) = 2025) AND (MONTH(dbo.tc_registrasi.tgl_jam_masuk) <= 11)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_tc_registrasi_v]");
    }
};
