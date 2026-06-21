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
        DB::unprepared("-- =============================================
-- Author:		<keni>
-- Create date: <22-12-2012>
-- Description:	<jurnal uang muka>
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[jurnal_uang_muka_sp]
AS
BEGIN


insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_bank,referensi,kode_inap) select acc_kredit as acc_no,uang_muka as tx_nominal,'Hutang Uang Muka Perawatan MR/REG '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,'1' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'3' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,'0' as kode_bank,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi,kode_inap from jurnal_uang_muka_v where acc_kredit>0 and flag_jurnal=0 and kode_jenis_proses=26;
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_bank,referensi,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,tunai as tx_nominal,'Penerimaan Uang Muka Perawatan MR/REG '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'2' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'3' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,'0' as kode_bank,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi,2279 as kd_trans_bendahara, 1 as kd_group_trans,kode_inap  from jurnal_uang_muka_v where  tunai>0 and flag_jurnal=0 and kode_jenis_proses=35;
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_bank,referensi,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,kredit as tx_nominal,'Penerimaan Uang Muka Perawatan MR/REG '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'3' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'3' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kd_bank_cc as kode_bank,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi,2279 as kd_trans_bendahara,1 as kd_group_trans,kode_inap  from jurnal_uang_muka_v where  kredit>0 and flag_jurnal=0 and kode_jenis_proses=37;
update ks_tc_trans_um set flag_jurnal=1 where flag_jurnal=0 and kode_tc_trans_kasir in(select kode_tc_trans_kasir from jurnal_uang_muka_v where flag_jurnal=0);
--update jurnal_uang_muka_v set flag_jurnal=1 where flag_jurnal=0;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_uang_muka_sp");
    }
};
