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

CREATE OR ALTER PROCEDURE [dbo].[jurnal_sed_obat_bebas_sp]
AS
BEGIN
	
	
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_kredit as acc_no,tx_nominal,'Pembelian Obat Bebas '+nama_bagian+' pasien/no.resep :'+nama_pasien_layan+'/'+no_resep as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'9' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan from jurnal_pembelian_obat_bebas_v2 where tx_nominal>0 and flag_jurnal=0;
	update jurnal_pembelian_obat_bebas_v set flag_jurnal=1 where flag_jurnal=0;
	update jurnal_pembelian_obat_bebas_v set flag_jurnal2=1 where flag_jurnal2 is null;
END

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_sed_obat_bebas_sp");
    }
};
