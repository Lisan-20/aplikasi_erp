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
        DB::unprepared("CREATE proc [dbo].[jurnal_rawat_inap_sp]
as
--update tc_trans_pelayanan set kode_perusahaan=0 where kode_perusahaan is null and status_selesai=3;
--exec jurnal_kasir_RI_sp;
--exec jurnal_sed_partik_RI_sp;
--exec jurnal_sed_partik_RI_ruangan_sp;
--exec jurnal_dr_partik_RI_sp;
--update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='RI' and flag_jurnal=0;
--update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='RI' and flag_jurnal=0;
--exec jurnal_UM_pasien_pulang_sp;

--umum/pt/ass
EXEC jurnal_tran_kasir_RI_sp;
EXEC jurnal_tran_sed_RI_sp;
EXEC jurnal_tran_sed_diskon_RI_sp;
EXEC jurnal_UM_pasien_pulang_sp;

-- asuransi--perusahaan--jamkesmas--sktm--jampersal
--exec jurnal_tran_kasir_AI_sp;
--exec jurnal_tran_sed_AI_sp;
update tran_sed set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='K');
update tran_sed set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='D');

--update tran_kasir set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='D');
--update tran_kasir set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='K');

--bpjs
--exec jurnal_tran_kasir_RI_BPJS_sp;
--exec jurnal_tran_sed_RI_BPJS_sp;
--exec jurnal_UM_pasien_pulang_bpjs_sp;

--update tran_sed set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='K');
--update tran_sed set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='D');

update tran_kasir set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='D');
update tran_kasir set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='K');

update tc_trans_kasir set flag_jurnal=1 where flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='D');
update tc_trans_pelayanan set flag_jurnal=1 where flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2 and tx_tipe='D');




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_rawat_inap_sp");
    }
};
