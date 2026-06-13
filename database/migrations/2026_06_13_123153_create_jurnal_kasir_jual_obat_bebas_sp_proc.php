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
CREATE PROCEDURE [dbo].[jurnal_kasir_jual_obat_bebas_sp]
AS
BEGIN
	
	update tran_kasir_bebas set kode_bagian='060101' Where kode_bagian='';

	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_jual_obat_bebas_v  where kode_jenis_proses=1 and jumlah>0 and flag_jurnal is null;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_jual_obat_bebas_v where kode_jenis_proses=2 and jumlah>0 and flag_jurnal is null;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_jual_obat_bebas_v where kode_jenis_proses=3 and jumlah>0 and flag_jurnal is null;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Diskon Khusus (Potongan) Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_jual_obat_bebas_v where kode_jenis_proses=4 and jumlah>0 and flag_jurnal is null;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_jual_obat_bebas_v where kode=5 and jumlah>0 and flag_jurnal is null and seri_kuitansi='AJ';

	update jurnal_kasir_jual_obat_bebas_v set flag_jurnal=1 where flag_jurnal is null;
	--update v_trans_kasir_obat_bebas set flag_jurnal=1 where flag_jurnal=0;
end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasir_jual_obat_bebas_sp");
    }
};
