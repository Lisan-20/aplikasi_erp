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
-- 
-- Create date: <22-12-2012>
-- Description:	<jurnal uang muka>
-- =============================================
CREATE PROCEDURE [dbo].[jurnal_UM_pasien_pulang_sp]
AS
BEGIN


insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,referensi,kode_inap) select acc_no,jumlah as tx_nominal,'Pelunasan Uang Muka Pasien Pulang MR/REG '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'1' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi,kode_inap from jurnal_UM_pasien_pulang_v where acc_no='2110301' and flag_jurnal is null;
update jurnal_UM_pasien_pulang_v set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2);
--UM pasien BPJS


END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_UM_pasien_pulang_sp");
    }
};
