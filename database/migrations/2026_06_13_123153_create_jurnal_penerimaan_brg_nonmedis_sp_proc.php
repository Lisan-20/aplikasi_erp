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



CREATE proc [dbo].[jurnal_penerimaan_brg_nonmedis_sp]

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
('Penerimaan barang' + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(kode_penerimaan as varchar(255))+SPACE(4)+'PO/LPB :'+ SPACE(2)+cast(no_po as varchar(255))+'/'+cast(no_po as varchar(255))) as tx_uraian,
				  tgl_penerimaan as tx_tgl,
					   getdate() as tx_jam,
							 'D' as	tx_tipe,
						kode_detail_penerimaan_barang as no_jurnal,
					     '1' as	no_det_jurnal,
				 kode_penerimaan as no_bukti,
						 petugas as no_induk,
							   7 as kel_jurnal,
									kode_bagian,
						kode_brg as	kode_barang,
					jumlah_kirim as jumlah_barang,
				 kode_penerimaan as referensi  FROM jurnal_pen_brg_nonmedis_v 
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
						kode_supplier,
						kode_barang,
						jumlah_barang,
						referensi
						) SELECT	
					  acc_kredit as acc_no,
						   harga as tx_nominal,
('Hutang sebelum faktur' + SPACE(2)+'Kode/Jumlah :'+ SPACE(2)+cast(kode_brg as varchar(255))+'/'+cast(kode_penerimaan as varchar(255))+SPACE(4)+'PO/LPB :'+ SPACE(2)+cast(no_po as varchar(255))+'/'+cast(no_po as varchar(255))) as tx_uraian,
				  tgl_penerimaan as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
							kode_detail_penerimaan_barang as 	no_jurnal,
					     '2' as	no_det_jurnal,
				 kode_penerimaan as no_bukti,
						 petugas as no_induk,
							   7 as kel_jurnal,
					kodesupplier as	kode_supplier,
						kode_brg as	kode_barang,
					jumlah_kirim as jumlah_barang,
							NULL as referensi  FROM jurnal_pen_brg_nonmedis_v 
											   WHERE acc_kredit>0 AND status_ver=0;

UPDATE jurnal_pen_brg_nonmedis_v SET status_ver=1 WHERE status_ver=0;

-- JURNAL PEN BARANG NON MEDIS
-- created	: 15-4-2011
-- By		: Bowo
-- Desc		: Jurnal Penerimaan Barang Non Medis




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_penerimaan_brg_nonmedis_sp");
    }
};
