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
        DB::statement("CREATE OR ALTER VIEW dbo.history_ruang_inap_v
AS
SELECT     TOP (100) PERCENT tgl_transaksi, bill_rs, jumlah, tgl_pindah, jenis_tindakan, kode_trans_pelayanan, no_mr, no_registrasi, tgl_transaksi AS tgl_masuk, kode_bagian, kode_klas, no_kamar, 
                      no_bed
FROM         dbo.tc_trans_pelayanan
WHERE     (jenis_tindakan = 1) AND (nama_tindakan LIKE 'Ruang%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [history_ruang_inap_v]");
    }
};
