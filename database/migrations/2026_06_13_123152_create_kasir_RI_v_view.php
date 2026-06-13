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
        DB::statement("CREATE VIEW dbo.kasir_RI_v
AS
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, tgl_jam, no_mr, no_registrasi, (CASE WHEN tunai IS NULL THEN 0 ELSE tunai END) + (CASE WHEN debet IS NULL 
                      THEN 0 ELSE debet END) + (CASE WHEN kredit IS NULL THEN 0 ELSE kredit END) + (CASE WHEN nk IS NULL THEN 0 ELSE nk END) 
                      + (CASE WHEN nk_karyawan IS NULL THEN 0 ELSE nk_karyawan END) + (CASE WHEN nk_perusahaan IS NULL THEN 0 ELSE nk_perusahaan END) 
                      + (CASE WHEN nk_askes IS NULL THEN 0 ELSE nk_askes END) AS kasir, flag_jurnal, nd, tunai, debet, kredit, nk, nk_karyawan, nk_perusahaan, nk_askes, 
                      kode_bagian, kode_perusahaan
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_RI_v]");
    }
};
