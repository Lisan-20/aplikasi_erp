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
        DB::statement("CREATE OR ALTER VIEW dbo.kasir_rj_v
AS
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, tgl_jam, no_mr, no_registrasi, tunai + debet + kredit + nk + nk_karyawan + nk_perusahaan + nk_askes AS kasir, 
                      flag_jurnal, nd, tunai, debet, kredit, nk, nk_karyawan, nk_perusahaan, nk_askes, kode_bagian, kode_perusahaan
FROM         dbo.tc_trans_kasir
WHERE     (seri_kuitansi = 'RJ' OR
                      seri_kuitansi = 'AJ') AND (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_rj_v]");
    }
};
