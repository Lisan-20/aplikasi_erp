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
CREATE OR ALTER PROCEDURE [dbo].[jurnal_penyusutan_sp]

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
						kel_jurnal,
						kode_bagian,
						kode_barang,
						jumlah_barang
						) SELECT	
					   acc_d as acc_no,
						   nominal_penyusutan as tx_nominal,
('Penyusutan Asset'+SPACE(2)+nama_bagian + SPACE(2)+'Kode Barang/Qty :'+ SPACE(2)+cast(kode_barang as varchar(255))+'/'+cast(qty as varchar(255))) as tx_uraian,
						tgl_proses as tx_tgl,
					    tgl_proses as tx_jam,
							  'D' as tx_tipe,
			id_tc_penyusutan_asset as no_jurnal,
							'1'	 as no_det_jurnal,								
				('AJS'+'-'+ cast(thn as varchar(255))+ cast(bln as varchar(255))) as no_bukti,
							  444 as kel_jurnal,
			   kode_bagian as kode_bagian,
						kode_barang as	kode_barang,
					qty as jumlah_barang
					
				   FROM jurnal_penyusutan_asset_v WHERE acc_d>0 AND flag_jurnal is null;
											   

insert into tx_harian (	acc_no,
						tx_nominal,
						tx_uraian,
						tx_tgl,
						tx_jam,
						tx_tipe,
						no_jurnal,
						no_det_jurnal,
						no_bukti,
						kel_jurnal,
						kode_bagian,
						kode_barang,
						jumlah_barang
						) SELECT	
					   acc_k as acc_no,
						   nominal_penyusutan as tx_nominal,
('Penyusutan Asset'+SPACE(2)+nama_bagian + SPACE(2)+'Kode Barang/Qty :'+ SPACE(2)+cast(kode_barang as varchar(255))+'/'+cast(qty as varchar(255))) as tx_uraian,
						tgl_proses as tx_tgl,
					    tgl_proses as tx_jam,
							  'K' as tx_tipe,
			id_tc_penyusutan_asset as no_jurnal,
							'1'	 as no_det_jurnal,								
				('AJS'+'-'+ cast(thn as varchar(255))+ cast(bln as varchar(255))) as no_bukti,
							  444 as kel_jurnal,
			   kode_bagian as kode_bagian,
						kode_barang as	kode_barang,
					qty as jumlah_barang
					
				   FROM jurnal_penyusutan_asset_v WHERE acc_k>0 AND flag_jurnal is null;
											   

											   
UPDATE jurnal_penyusutan_asset_v SET flag_jurnal=1 WHERE flag_jurnal is null;
--UPDATE jurnal_persediaan_upd_v SET status_ver=0 WHERE status_ver=1;
-- JURNAL PERSEDIAAN
-- created	: 2013
-- By		: ME
-- Desc		: Jurnal Persediaan

--update kartu hutang



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_penyusutan_sp");
    }
};
