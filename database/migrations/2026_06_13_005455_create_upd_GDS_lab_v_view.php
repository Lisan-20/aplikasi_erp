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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_GDS_lab_v
AS
SELECT     id_fee_dr_ri_temp, kode_dr, no_kunjungan, no_registrasi, no_mr, seri_kuitansi, no_kuitansi, tgl_transaksi, tgl_kuitansi, kode_bagian, nama_tindakan, kode_trans_pelayanan, no_sppu, flag_sppu, 
                      tahun, jumlah, kode_kelompok, kode_perusahaan, kode_tc_trans_kasir, nama_pasien, no_induk, flag_umum, flag_pt, flag_ass, flag_bpjs, jumlah * 100 AS total, 
                      jumlah * 100 * 80 / 100 AS jml_sekarang
FROM         dbo.fee_dokter_rinap_temp
WHERE     (kode_dr = 138) AND (MONTH(tgl_kuitansi) = 12) AND (nama_tindakan LIKE 'GLUKOSA DARAH SEWAKTU%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_GDS_lab_v]");
    }
};
