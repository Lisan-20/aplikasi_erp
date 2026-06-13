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



CREATE proc [dbo].[jurnal_persediaan_sp]

as

insert into tx_harian (	acc_no,
						tx_nominal,
						tx_uraian,
						tx_tgl,
						tx_jam,
						tx_tipe,
						no_jurnal,
						no_det_jurnal,
						no_bukti,
						no_induk,
						kel_jurnal,
						kode_bagian,
						kode_barang,
						jumlah_barang,
						referensi
						) SELECT	
					   acc_debet as acc_no,
						   harga as tx_nominal,
('Persediaan Obat Alkes'+SPACE(2)+nama_bagian + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(jumlah_penerimaan as varchar(255))) as tx_uraian,
						tgl_kirim as tx_tgl,
					    getdate() as tx_jam,
							  'D' as tx_tipe,
									 no_jurnal,
							'1'	 as no_det_jurnal,								
				nomor_permintaan as no_bukti,
					  id_dd_user as no_induk,
							  21 as kel_jurnal,
			   kode_bagian_minta as kode_bagian,
						kode_brg as	kode_barang,
					jumlah_penerimaan as jumlah_barang,
				 nomor_permintaan as referensi  FROM jurnal_permintaan_unit_debet_v 
											   WHERE acc_debet>0 AND status_ver=0;
insert into tx_harian (	acc_no,
						tx_nominal,
						tx_uraian,
						tx_tgl,
						tx_jam,
						tx_tipe,
						no_jurnal,
						no_det_jurnal,
						no_bukti,
						no_induk,
						kel_jurnal,
						kode_bagian,
						kode_barang,
						jumlah_barang,
						referensi
						) SELECT	
					  acc_kredit as acc_no,
						   harga as tx_nominal,
('Persediaan Obat Alkes'+ SPACE(2)+nama_bagian + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(jumlah_penerimaan as varchar(255))) as tx_uraian,
				  tgl_kirim as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
									no_jurnal,
					     '2' as	no_det_jurnal,
				 nomor_permintaan as no_bukti,
						 id_dd_user as no_induk,
							   21 as kel_jurnal,
			   kode_bagian_kirim as	kode_bagian,
						kode_brg as	kode_barang,
					jumlah_penerimaan as jumlah_barang,
							nomor_permintaan as referensi  FROM jurnal_pengiriman_unit_kredit_v 
											   WHERE acc_kredit>0 AND status_ver=0;
											   
-- jurnal cogs
insert into tx_harian (	acc_no,
						tx_nominal,
						tx_uraian,
						tx_tgl,
						tx_jam,
						tx_tipe,
						no_jurnal,
						no_det_jurnal,
						no_bukti,
						no_induk,
						kel_jurnal,
						kode_bagian,
						kode_barang,
						jumlah_barang,
						referensi
						) SELECT	
					   '4120104' as acc_no,
						   harga as tx_nominal,
('Biaya Obat Alkes'+SPACE(2)+nama_bagian + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(jumlah_penerimaan as varchar(255))) as tx_uraian,
						tgl_kirim as tx_tgl,
					    getdate() as tx_jam,
							  'D' as tx_tipe,
									 no_jurnal,
							'1'	 as no_det_jurnal,								
				nomor_permintaan as no_bukti,
					  id_dd_user as no_induk,
							  21 as kel_jurnal,
			   kode_bagian_minta as kode_bagian,
						kode_brg as	kode_barang,
					jumlah_penerimaan as jumlah_barang,
				 nomor_permintaan as referensi  FROM jurnal_permintaan_unit_debet_v 
											   WHERE acc_debet>0 AND status_ver=0 and kode_bagian_minta not like '03%' and kode_bagian_minta not like '02%' and kode_bagian_minta not like '01%' and kode_bagian_minta not like '05%' and kode_bagian_minta not like '06%' and kode_bagian_minta not like '50%';
insert into tx_harian (	acc_no,
						tx_nominal,
						tx_uraian,
						tx_tgl,
						tx_jam,
						tx_tipe,
						no_jurnal,
						no_det_jurnal,
						no_bukti,
						no_induk,
						kel_jurnal,
						kode_bagian,
						kode_barang,
						jumlah_barang,
						referensi
						) SELECT	
					  acc_debet as acc_no,
						   harga as tx_nominal,
('Persediaan Obat Alkes'+ SPACE(2)+nama_bagian + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(jumlah_penerimaan as varchar(255))) as tx_uraian,
				  tgl_kirim as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
									no_jurnal,
					     '2' as	no_det_jurnal,
				 nomor_permintaan as no_bukti,
						 id_dd_user as no_induk,
							   21 as kel_jurnal,
			   kode_bagian_minta as	kode_bagian,
						kode_brg as	kode_barang,
					jumlah_penerimaan as jumlah_barang,
							nomor_permintaan as referensi  FROM jurnal_permintaan_unit_debet_v 
											   WHERE acc_debet>0 AND status_ver=0 and kode_bagian_minta not like '03%' and kode_bagian_minta not like '02%' and kode_bagian_minta not like '01%' and kode_bagian_minta not like '05%' and kode_bagian_minta not like '06%' and kode_bagian_minta not like '50%';
											   
UPDATE jurnal_persediaan_upd_v SET status_ver=1 WHERE status_ver=0;
--UPDATE jurnal_persediaan_upd_v SET status_ver=0 WHERE status_ver=1;
-- JURNAL PERSEDIAAN
-- created	: 2013
-- By		: ME
-- Desc		: Jurnal Persediaan

--update kartu hutang
exec update_ref_sp;



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_persediaan_sp");
    }
};
