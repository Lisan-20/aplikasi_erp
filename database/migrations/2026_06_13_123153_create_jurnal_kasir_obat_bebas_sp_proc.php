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
CREATE PROCEDURE [dbo].[jurnal_kasir_obat_bebas_sp]
AS
BEGIN
	
	
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,tunai as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien_layan +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_pembelian_obat_bebas_v  where kode_jenis_proses=1 and tunai>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,debet as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien_layan +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_pembelian_obat_bebas_v where kode_jenis_proses=2 and debet>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,kredit as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien_layan +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_pembelian_obat_bebas_v where kode_jenis_proses=3 and kredit>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,nk_karyawan as tx_nominal,'Penerimaan Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien_layan +'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_pembelian_obat_bebas_v where kode_jenis_proses=3 and nk_karyawan>0 and flag_jurnal=0 and seri_kuitansi='AJ';

	update jurnal_kasir_pembelian_obat_bebas_v set flag_jurnal=1 where flag_jurnal=0;
end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasir_obat_bebas_sp");
    }
};
