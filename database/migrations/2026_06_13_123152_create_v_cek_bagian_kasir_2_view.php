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
        DB::statement("CREATE OR ALTER VIEW dbo.v_cek_bagian_kasir_2
AS
SELECT     kode_tc_trans_kasir, kode_bagian, seri_kuitansi, tgl_jam, no_registrasi
FROM         dbo.tc_trans_kasir
GROUP BY kode_tc_trans_kasir, kode_bagian, seri_kuitansi, tgl_jam, no_registrasi
HAVING      (seri_kuitansi IN ('RJ', 'AJ'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_bagian_kasir_2]");
    }
};
