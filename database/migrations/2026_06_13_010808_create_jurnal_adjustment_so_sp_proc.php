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



CREATE OR ALTER PROCEDURE [dbo].[jurnal_adjustment_so_sp]

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
					   '1150101' as acc_no,
						   (harga_beli*pemasukan) as tx_nominal,
('Selisih Persediaan :'+ SPACE(2)+cast(id_kartu as varchar(255))+SPACE(4)+'Kode/Jumlah'+cast(kode_brg as varchar(255))+'/'+cast(pemasukan as varchar(255))) as tx_uraian,
					  tgl_input as tx_tgl,
					   getdate() as tx_jam,
							 'D' as	tx_tipe,
						id_kartu as	no_jurnal,
					    id_kartu as	no_det_jurnal,
				('AJP/'+ cast(id_kartu as varchar(255))) as no_bukti,
									no_induk,
							  25 as kel_jurnal,
									kode_bagian,
						kode_brg as	kode_barang,
			   pemasukan as jumlah_barang,
							NULL as referensi  FROM v_verifikasi_so 
											   WHERE pemasukan>0 AND status_ver=0;
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
					  '1150105' as acc_no,
						   (harga_beli*pemasukan) as tx_nominal,
('Selisih Persediaan :'+ SPACE(2)+cast(id_kartu as varchar(255))+SPACE(4)+'Kode/Jumlah'+cast(kode_brg as varchar(255))+'/'+cast(pemasukan as varchar(255))) as tx_uraian,
				       tgl_input as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
						id_kartu as	no_jurnal,
					     id_kartu as	no_det_jurnal,
				('AJP/'+ cast(id_kartu as varchar(255))) as no_bukti,
									no_induk,
							  25 as kel_jurnal,
									kode_bagian,
						kode_brg as	kode_barang,
			   pemasukan as jumlah_barang,
							NULL as referensi  FROM v_verifikasi_so 
											   WHERE pemasukan>0 AND status_ver=0;


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
					   '1150104' as acc_no,
						   (harga_beli*pengeluaran) as tx_nominal,
('Selisih Persediaan :'+ SPACE(2)+cast(id_kartu as varchar(255))+SPACE(4)+'Kode/Jumlah'+cast(kode_brg as varchar(255))+'/'+cast(pengeluaran as varchar(255))) as tx_uraian,
					  tgl_input as tx_tgl,
					   getdate() as tx_jam,
							 'D' as	tx_tipe,
						id_kartu as	no_jurnal,
					    id_kartu as	no_det_jurnal,
				('AJP/'+ cast(id_kartu as varchar(255))) as no_bukti,
									no_induk,
							  14 as kel_jurnal,
									kode_bagian,
						kode_brg as	kode_barang,
			   pengeluaran as jumlah_barang,
							NULL as referensi  FROM v_verifikasi_so 
											   WHERE pengeluaran>0 AND status_ver=0;
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
					  '1150101' as acc_no,
						   (harga_beli*pengeluaran) as tx_nominal,
('Selisih Persediaan :'+ SPACE(2)+cast(id_kartu as varchar(255))+SPACE(4)+'Kode/Jumlah'+cast(kode_brg as varchar(255))+'/'+cast(pengeluaran as varchar(255))) as tx_uraian,
				       tgl_input as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
						id_kartu as	no_jurnal,
					     id_kartu as	no_det_jurnal,
				('AJP/'+ cast(id_kartu as varchar(255))) as no_bukti,
									no_induk,
							  14 as kel_jurnal,
									kode_bagian,
						kode_brg as	kode_barang,
			   pengeluaran as jumlah_barang,
							NULL as referensi  FROM v_verifikasi_so 
											   WHERE pengeluaran>0 AND status_ver=0;
UPDATE v_verifikasi_so SET status_ver=1 WHERE status_ver=0;

-- JURNAL BIAYA
-- created	: 11-4-2018
-- By		: Bowo
-- Desc		: Jurnal Adjustment SO






");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_adjustment_so_sp");
    }
};
