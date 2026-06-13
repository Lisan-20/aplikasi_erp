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
        DB::unprepared("CREATE proc [dbo].[restore_db_all]
as

truncate table  tc_kartu_hutang
truncate table  tc_kartu_piutang
truncate table  tc_kartu_stok
truncate table  tc_kartu_stok_nm
truncate table  tc_kartu_stokbebas
truncate table  tc_kartu_stokcito
truncate table  tc_trans_pelayanan

truncate table  bd_tc_bayar_dr
truncate table  bd_tc_bayar_pajak_dr
truncate table  bd_tc_hutang_dr
truncate table  bd_tc_setoran
truncate table  bd_tc_trans
truncate table  bd_tc_trans_detail

truncate table  gd_fr_tc_gudang
truncate table  gd_fr_tc_gudang_detail
truncate table  gd_tc_cetak_racun
truncate table  gd_tc_cetak_visum
truncate table  gd_tc_gawat_darurat
truncate table  gd_tc_status_harian

truncate table  ks_tc_trans_um

truncate table  pm_tc_hasilpenunjang
truncate table  pm_tc_obalkes
truncate table  pm_tc_penunjang

truncate table  rg_tc_rujukan
truncate table  ri_tc_rawatinap
truncate table  ri_tc_rawatinap_det
truncate table  ri_tc_riwayat_kelas


truncate table  tc_registrasi
truncate table  tc_kunjungan
truncate table  th_riwayat_pasien
truncate table  pl_tc_poli
truncate table  pm_tc_penunjang
truncate table  tc_trans_kasir
truncate table  tc_dpjp_rinap
truncate table  tc_fee_dokter
truncate table  tc_fee_dokter_bpjs
truncate table  tc_fee_dokter_man
truncate table  tc_kuitansi_gabung
truncate table  tc_obat_ruangan
truncate table  tc_oksigen
truncate table  tc_p3k
truncate table  fr_tc_far
truncate table  fr_tc_far_detail
truncate table  fr_tc_far_his
truncate table  fr_return_rj
truncate table  fr_tc_pesan_resep
truncate table  gd_tc_gawat_darurat
truncate table  gd_th_kematian
truncate table  gd_th_rujuk_ri
truncate table  gd_th_rujuk_rs
truncate table  gd_tc_cetak_visum
truncate table  gd_tc_cetak_racun
truncate table  tbl_obat_racikan_temp
truncate table  tc_retur_unit
truncate table  tc_retur_unit_det


truncate table fr_gg_kirim_brg
truncate table fr_gg_penerimaan_brg
truncate table fr_gg_permintaan_brg
truncate table fr_gg_return_brg

truncate table tc_pemakaian_brg_nm
truncate table tc_pengambilan_brg_gizi
truncate table tc_pengambilan_brg_gizi_det
truncate table tc_pngeambilan_brg_gizi

truncate table tc_permohonan
truncate table tc_permohonan_cash
truncate table tc_permohonan_cash_det
truncate table tc_permohonan_cash_det_gizi
truncate table tc_permohonan_cash_gizi
truncate table tc_permohonan_det
truncate table tc_permohonan_detail
truncate table tc_permohonan_gizi
truncate table tc_permohonan_gizi_det
truncate table tc_permohonan_nm
truncate table tc_permohonan_nm_det

truncate table tc_bayar_tagih
truncate table tc_bayar_tagih_det
truncate table tc_tagih_det
truncate table tc_tagih
truncate table transaksi_piutang




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS restore_db_all");
    }
};
