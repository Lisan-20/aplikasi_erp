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



CREATE OR ALTER PROCEDURE [dbo].[jurnal_pengiriman_rs_sp]

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
						kode_perusahaan,
						kode_barang,
						jumlah_barang,
						referensi
						) SELECT	
					   1130102 as acc_no,
						    (harga_sat*jumlah) as tx_nominal,
('Piutang Usaha Hubungan Khusus' + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(jumlah as varchar(255))+SPACE(4)+'No Kirim :'+ SPACE(2)+cast(no_kirim as varchar(255))) as tx_uraian,
				  tgl_trans as tx_tgl,
					   getdate() as tx_jam,
							 'D' as	tx_tipe,
						kode_trans_gudang AS no_jurnal,
					     '1' as	no_det_jurnal,
			 no_kirim as no_bukti,
						 petugas as no_induk,
							   23 as kel_jurnal,
									kode_perusahaan,
						kode_brg as	kode_barang,
					jumlah as jumlah_barang,
				 no_kirim as referensi  FROM jurnal_pengiriman_rs_cab_v 
											   WHERE flag_jurnal=0;
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
					  1150101 as acc_no,
						    (harga_sat*jumlah) as tx_nominal,
('Pengiriman Obat Alkes' + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(jumlah as varchar(255))+SPACE(4)+'No Kirim :'+ SPACE(2)+cast(no_kirim as varchar(255))) as tx_uraian,
				  tgl_trans as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
				kode_trans_gudang as no_jurnal,
					     '2' as	no_det_jurnal,
				 no_kirim as no_bukti,
						 petugas as no_induk,
							   23 as kel_jurnal,
								kode_bagian,
						kode_brg as	kode_barang,
					jumlah as jumlah_barang,
							NULL as referensi  FROM jurnal_pengiriman_rs_cab_v 
											   WHERE flag_jurnal=0;

UPDATE jurnal_pengiriman_rs_cab_v SET flag_jurnal=1 WHERE flag_jurnal=0;
-- JURNAL PENGIRIMAN BARANG MEDIS KE RS CABANG
-- created	: 16-01-2014



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_pengiriman_rs_sp");
    }
};
