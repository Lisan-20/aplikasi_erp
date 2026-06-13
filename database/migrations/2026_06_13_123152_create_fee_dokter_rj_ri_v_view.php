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
        DB::statement("CREATE VIEW dbo.fee_dokter_rj_ri_v
AS
SELECT   kode_dr, no_registrasi, no_mr, seri_kuitansi, no_kuitansi, tgl_transaksi, tgl_kuitansi, kode_bagian, nama_tindakan, kode_trans_pelayanan, no_sppu, flag_sppu, tahun, jumlah, kode_kelompok, kode_perusahaan
FROM         dbo.fee_dokter_rinap_temp
UNION
SELECT    kode_dr, no_registrasi, no_mr, seri_kuitansi, no_kuitansi, tgl_transaksi, tgl_kuitansi, kode_bagian, nama_tindakan, kode_trans_pelayanan, no_sppu, flag_sppu, tahun, jumlah, kode_kelompok, kode_perusahaan
FROM         dbo.fee_dokter_rajal_temp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_rj_ri_v]");
    }
};
