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
        DB::statement("CREATE OR ALTER VIEW dbo.laporan_kasir_v
AS
SELECT     jenis_tindakan, nama_tindakan, bill_rs, bill_rs_jatah, kode_perusahaan, kode_kelompok, kode_tc_trans_kasir, tgl_transaksi, nama_pasien_layan, kode_bagian, 
                      no_mr
FROM         dbo.tc_trans_pelayanan
WHERE     (jenis_tindakan = 2) AND (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kasir_v]");
    }
};
