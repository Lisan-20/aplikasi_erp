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

CREATE OR ALTER PROCEDURE [dbo].[jurnal_ALL_sp]
AS
BEGIN
--exec semi_jurnal_ALL_sp;
--jurnal rawat jalan
exec jurnal_rawat_jalan_baru_sp;

--jurnal pembelian obat bebas
--exec jurnal_kasir_obat_bebas_sp;
--exec jurnal_sed_obat_bebas_sp;
exec jurnal_kasir_jual_obat_bebas_sp;
exec jurnal_sed_jual_obat_bebas_sp;

--sementara dp 20.04.2018
update update_acc_obat_rj_v set acc_no=3150102;
update update_acc_obat_rj_IGD_v set acc_no=3150102;



--jurnal transaksi kasir lainnya
exec jurnal_kasir_TU_sp;

--jurnal pembayaran UM
exec jurnal_uang_muka_sp;
 
--jurnal rawat inap
exec jurnal_rawat_inap_sp;
--jurnal cogs
exec jurnal_cogs_radiologi_sp;
exec jurnal_cogs_ri_sp;
exec jurnal_cogs_rj_sp;
exec jurnal_cogs_jual_bebas_sp;--19
--JURNAL BALIK KARYAWAN
--EXEC jurnal_balik_karyawan_sp;

exec jurnal_biaya_gizi_RI_sp;
exec jurnal_selisih_minus_bpjs_ri_sp;
exec jurnal_selisih_minus_bpjs_RJ_sp


--jurnal pembayaran supplier
--exec jurnal_bayar_supplier_sp;-- ga dipakai

--jurnal kas bank
exec jurnal_kasbank_sp;

-- jurnal penagihan
exec jurnal_penagihan_sp;

--jurnal tukar faktur
exec jurnal_tukar_faktur_sp;

--exec jurnal penerimaan obat alkes
exec jurnal_penerimaan_brg_medis_sp;

--jurnal penerimaan brg nonmedis
exec jurnal_penerimaan_brg_nonmedis_sp;

--jurnal kuitansi batal
--exec jurnal_kuitansi_batal_sp;

-- JURNAL PEMBENTUKAN FEE DOKTER
EXEC jurnal_fee_dokter_sp;

-- JURNAL PERSEDIAAN GUDANG - PERSEDIAAN UNIT
EXEC jurnal_persediaan_sp;
EXEC jurnal_persediaan_NM_sp;

--JURNAL PJ UMD SELISIH = 0
EXEC jurnal_pj_umd_sp;

--jurnal penyusutan
EXEC jurnal_penyusutan_sp;--- kel jurnal 444

--jurnal  luar modul
exec jurnal_hutang_luar_modul_sp;
exec jurnal_piutang_luar_modul_sp;
--jurnal pengiriman brg ke rs cabang
exec jurnal_pengiriman_rs_sp;
--jurnal batal uang muka
exec jurnal_um_batal_sp;

exec update_ref_sp; -- update kartu hutang dan kartu piutang
--dedy 29/05/2015
update update_kode_dokter_trans_pelayanan_v set kode_dokter1=kode_dokter;

--dd dedy 05/10/2016
DELETE FROM tx_harian WHERE tx_nominal = 0;

--- update biaya obat ke alkes
update update_alkes_tx_harian_ri_v set acc_no=4110105;
update update_alkes_tx_harian_rj_v set acc_no=4120105;
update update_alkes_tx_harian_PM_v set acc_no=4130105;
update update_alkes_tx_harian_APT_v set acc_no=4140105;


update update_pendapatan_alkes_tx_harian_RJ_v set acc_no=3150104;
update update_pendapatan_alkes_tx_harian_RI_v set acc_no=3150103;

--dd 10/10/2017
update tx_harian set ko_wil=101 where ko_wil=0;
update tx_harian set ko_wil=101 where ko_wil is null;

END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_ALL_sp");
    }
};
