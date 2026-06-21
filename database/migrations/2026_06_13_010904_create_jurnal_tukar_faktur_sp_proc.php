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

CREATE OR ALTER PROCEDURE [dbo].[jurnal_tukar_faktur_sp]

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
						kode_supplier,
						referensi,
						tgl_tempo
						) SELECT	
					   acc_debet as acc_no,
					 total_harga as tx_nominal,
('Hutang sebelum faktur' + SPACE(2)+'No.Voucher :'+ SPACE(2)+cast(no_voucher as varchar(255))) as tx_uraian,
					 tgl_invoice as tx_tgl,
					   getdate() as tx_jam,
							 'D' as	tx_tipe,
									no_jurnal,
					     '1' as	no_det_jurnal,
					  no_voucher as no_bukti,
									no_induk,
							   '8' as kel_jurnal,
					kodesupplier as	kode_supplier,
					  no_voucher as referensi,
					  tgl_jt as tgl_tempo    FROM jurnal_tukar_faktur 
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
						referensi,
						tgl_tempo
						) SELECT	
					  acc_kredit as acc_no,
					 total_harga as tx_nominal,
('Hutang supplier' + SPACE(2)+'No.Voucher :'+ SPACE(2)+cast(no_voucher as varchar(255))) as tx_uraian,
				     tgl_invoice as tx_tgl,
					   getdate() as tx_jam,
							 'K' as	tx_tipe,
									no_jurnal,
					     '2' as	no_det_jurnal,
					  no_voucher as no_bukti,
									no_induk,
							   '8' as kel_jurnal,
					kodesupplier as	kode_supplier,
					  no_voucher as referensi,
						tgl_jt   as tgl_tempo  FROM jurnal_tukar_faktur 
											   WHERE acc_kredit>0 AND status_ver=0;

UPDATE jurnal_tukar_faktur SET status_ver=1 WHERE status_ver=0;
update upd_tgl_jatuh_tempo_v set tgl_tempo=tgl_jt;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_tukar_faktur_sp");
    }
};
