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
CREATE PROCEDURE [dbo].[hapus_data_live_sp]
	

AS
exec tarik_fr_tc_2far_sp
exec tarik_fr_tc_2far_detail_sp
update update_registrasi_tc_pemeriksaan_erm_v set no_registrasi=no_registrasi_up

-- tc_trans_kasir
DELETE tc_trans_kasir WHERE  seri_kuitansi not like'UM%' and  (kode_tc_trans_kasir IN
                             (SELECT        kode_tc_trans_kasir
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_trans_kasir')))

-- tc_registrasi
DELETE tc_registrasi WHERE        (id_tc_registrasi IN
                             (SELECT        id_tc_registrasi2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_registrasi')))

-- tc_kunjungan
DELETE  tc_kunjungan WHERE        (id_tc_kunjungan IN
                             (SELECT        id_tc_kunjungan2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_kunjungan')))


-- pl_tc_poli
DELETE   pl_tc_poli WHERE        (id_pl_tc_poli IN
                             (SELECT        id_pl_tc_poli2
                               FROM            OPENQUERY(SVR_BACK, 'select * from pl_tc_poli')))
-- gd_tc_gawat_darurat
DELETE  gd_tc_gawat_darurat WHERE        (kode_gd IN
                             (SELECT        kode_gd2
                               FROM            OPENQUERY(SVR_BACK, 'select * from gd_tc_gawat_darurat')))

-- fr_tc_far
DELETE   fr_tc_far WHERE        (kode_trans_far IN
                             (SELECT        kode_trans_far
                               FROM            OPENQUERY(SVR_BACK, 'select * from fr_tc_far')))

							   
-- fr_tc_far_detail
DELETE fr_tc_far_detail WHERE        (kd_tr_resep IN
                             (SELECT        kd_tr_resep2
                               FROM            OPENQUERY(SVR_BACK, 'select * from fr_tc_far_detail')))

							   
-- fr_tc_far_his
DELETE   fr_tc_far_his WHERE        (kd_his IN
                             (SELECT        kd_his2
                               FROM            OPENQUERY(SVR_BACK, 'select * from fr_tc_far_his')))

-- tbl_obat_racikan_temp
DELETE    tbl_obat_racikan_temp WHERE        (id IN
                             (SELECT        id2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tbl_obat_racikan_temp')))

-- tc_trans_pelayanan
DELETE      tc_trans_pelayanan WHERE        (kode_trans_pelayanan IN
                             (SELECT        kode_trans_pelayanan
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_trans_pelayanan')))
                    
                    
-- REKAM MEDIS                
                    
-- tc_pemeriksaan_erm
DELETE      tc_pemeriksaan_erm WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_erm')))                   
-- tc_hasil_pemeriksaan_luar
DELETE      tc_hasil_pemeriksaan_luar WHERE        (id_luar IN
                             (SELECT        id_luar2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_hasil_pemeriksaan_luar')))                
-- tc_pemeriksaan_apgar
DELETE      tc_pemeriksaan_apgar WHERE        (no_urut_apgar IN
                             (SELECT        no_urut_apgar2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_apgar')))
-- tc_pemeriksaan_fisio
DELETE      tc_pemeriksaan_fisio WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_fisio')))        
 
 -- tc_pemeriksaan_dokter
DELETE      tc_pemeriksaan_dokter WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_dokter')))  
                             
-- tc_pemeriksaan_triase
DELETE      tc_pemeriksaan_triase WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_triase')))  
             
-- tc_pemeriksaan_ri
DELETE      tc_pemeriksaan_ri WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_ri')))   
           
-- tc_pemeriksaan_igd
DELETE      tc_pemeriksaan_igd WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_igd')))   
           
-- tc_pemeriksaan_ews
DELETE      tc_pemeriksaan_ews WHERE        (no_urut_ews IN
                             (SELECT        no_urut_ews
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_ews')))   
           
-- tc_pemeriksaan_ews_det
DELETE      tc_pemeriksaan_ews_det WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_ews_det')))   
-- tc_identitas_triase
DELETE      tc_identitas_triase WHERE        (id IN
                             (SELECT        id
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_identitas_triase')))   

-- tc_pemeriksaan_hemo
DELETE      tc_pemeriksaan_hemo WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_hemo')))   


-- tc_pemeriksaan_luar
DELETE      tc_pemeriksaan_luar WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_luar')))   


-- tc_pemeriksaan_perawat
DELETE      tc_pemeriksaan_perawat WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_perawat')))   


-- tc_pemeriksaan_resep
DELETE      tc_pemeriksaan_resep WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_resep')))   


-- tc_pemeriksaan_cairan
DELETE      tc_pemeriksaan_cairan WHERE        (no_imbang IN
                             (SELECT        no_imbang
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_cairan')))   

  
-- tc_pemeriksaan_cairan_det
DELETE      tc_pemeriksaan_cairan_det WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_cairan_det')))   

-- tc_pemeriksaan_imp
DELETE      tc_pemeriksaan_imp WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_imp')))   

  
-- tc_pemeriksaan_imp_det
DELETE      tc_pemeriksaan_imp_det WHERE        (kode_tc_periksa IN
                             (SELECT        kode_tc_periksa2
                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_pemeriksaan_imp_det')))   

 
-- tc_pemeriksaan_imp_det
--DELETE      tc_emr_form WHERE        (id_tc_emr IN
--                             (SELECT        id_tc_emr2
--                               FROM            OPENQUERY(SVR_BACK, 'select * from tc_emr_form')))   

 
 
 --------------- nambahin
 insert into  fr_far_resep_ri_dokter_back   (id_resep_ri_dr, kode_resep, no_kunjungan, no_registrasi, no_mr, kode_dokter, tgl_input, kode_brg, jumlah, satuan, nama_brg, harga, takaran, penggunaan, instruksi, jml_pakai, jml_takar,
                       jam_pemberian, jml_konversi, komp_dtd, racikan_obat_tambahan, racik, flag_kirim, jam1, jam2, jam3, jam4, jam5, st_pesan, tgl_st_pesan, id_user_st_pesan, interaksi, duplikasi, dosis, alergi, 
                      kontra, user_id_apot, tgl_review, st_review, st_stop, tgl_st_stop, id_user_st_stop, id_user_st_review, kode_rm, kode_bagian_isi, isi_cara, isi_waktu, isi_signa, st_rek_awal, tgl_rek_awal, 
                      id_user_rek, bentuk_reaksi, tgl_ass_alergi, id_user_alergi, st_alergi, flag_perawat, flag_igd_resep, jam_khusus, kode_bagian_inp, flag_permintaan)
 SELECT    id_resep_ri_dr, kode_resep, no_kunjungan, no_registrasi, no_mr, kode_dokter, tgl_input, kode_brg, jumlah, satuan, nama_brg, harga, takaran, penggunaan, instruksi, jml_pakai, jml_takar,
                       jam_pemberian, jml_konversi, komp_dtd, racikan_obat_tambahan, racik, flag_kirim, jam1, jam2, jam3, jam4, jam5, st_pesan, tgl_st_pesan, id_user_st_pesan, interaksi, duplikasi, dosis, alergi, 
                      kontra, user_id_apot, tgl_review, st_review, st_stop, tgl_st_stop, id_user_st_stop, id_user_st_review, kode_rm, kode_bagian_isi, isi_cara, isi_waktu, isi_signa, st_rek_awal, tgl_rek_awal, 
                      id_user_rek, bentuk_reaksi, tgl_ass_alergi, id_user_alergi, st_alergi, flag_perawat, flag_igd_resep, jam_khusus, kode_bagian_inp, flag_permintaan
FROM         fr_far_resep_ri_dokter_back_v
                                      
 
 DELETE fr_far_resep_ri_dokter WHERE    (id_resep_ri_dr IN
                             (SELECT        id_resep_ri_dr
                               FROM            fr_far_resep_ri_dokter_back))
                                                                                    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS hapus_data_live_sp");
    }
};
