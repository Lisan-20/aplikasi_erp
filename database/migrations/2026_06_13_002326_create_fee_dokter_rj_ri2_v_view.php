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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_dokter_rj_ri2_v
AS
SELECT     DAY(tgl_transaksi) AS tgl, MONTH(tgl_transaksi) AS bln, YEAR(tgl_transaksi) AS thn, kode_dr, kode_trans_pelayanan, nama_tindakan, no_sppu, flag_sppu, tahun, 
                      jumlah, kode_kelompok, tgl_transaksi, seri_kuitansi
FROM         dbo.fee_dokter_rj_ri_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_rj_ri2_v]");
    }
};
