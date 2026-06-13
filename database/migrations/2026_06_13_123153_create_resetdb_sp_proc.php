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
        DB::unprepared("CREATE OR ALTER PROCEDURE resetdb_sp

as
--begin pelayanan
truncate table tc_registrasi
truncate table tc_trans_pelayanan
truncate table tc_trans_kasir
truncate table fr_tc_far
truncate table fr_tc_far_detail
truncate table fr_tc_far_his
truncate table ri_tc_rawatinap
truncate table ri_tc_rawatinap_det
truncate table ri_tc_riwayat_kelas
truncate table rg_tc_rujukan
truncate table pl_tc_poli
truncate table tc_kunjungan
truncate table ks_tc_trans_um
truncate table gd_tc_gawat_darurat
truncate table gd_tc_cetak_visum
truncate table gd_tc_cetak_racun
truncate table gd_fr_tc_gudang_detail
truncate table gd_fr_tc_gudang
truncate table fr_tc_pesan_resep
truncate table pm_tc_penunjang
truncate table pm_tc_obalkes
truncate table pm_tc_hasilpenunjang


--pelayanan end

--begin finance
truncate table bd_tc_trans
truncate table bd_tc_trans_detail
truncate table tc_tagih
truncate table tc_tagih_det
truncate table tc_bayar_tagih
truncate table tc_bayar_tagih_det
truncate table transaksi_umd
truncate table transaksi_umd_detail
truncate table transaksi_umd_gudang
truncate table transaksi_pj_umd
truncate table bd_tc_bayar_dr
truncate table bd_tc_bayar_pajak_dr
truncate table bd_tc_hutang_dr
truncate table bd_tc_setoran



--finance end

--inventory begin
truncate table tc_permohonan
truncate table tc_permohonan_det
truncate table tc_permohonan_detail
truncate table tc_permohonan_gizi
truncate table tc_permohonan_gizi_det
truncate table tc_permohonan_nm
truncate table tc_permohonan_nm_det
truncate table tc_po
truncate table tc_po_det
truncate table tc_po_nm
truncate table tc_po_nm_det
truncate table tc_stok_opname
truncate table tc_stok_opname_nm
truncate table tc_kartu_stok
truncate table tc_kartu_stok_nm
truncate table tc_kartu_stokbebas
truncate table tc_kartu_stokcito

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS resetdb_sp");
    }
};
