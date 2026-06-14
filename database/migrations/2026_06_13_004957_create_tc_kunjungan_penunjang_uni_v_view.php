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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kunjungan_penunjang_uni_v
AS
SELECT     no_kunjungan, no_registrasi, no_mr, kode_dokter, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, keterangan, status_batal, flag_um, 
                      kode_tc_trans_kasir, user_batal
FROM         dbo.tc_kunjungan
WHERE     (status_batal IS NULL) AND (kode_bagian_tujuan LIKE '05%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_penunjang_uni_v]");
    }
};
