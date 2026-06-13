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
        DB::statement("CREATE VIEW dbo.jumlah_kasir_rj_ver_v
AS
SELECT     kode_tc_trans_kasir, (CASE WHEN tunai IS NULL THEN 0 ELSE tunai END + CASE WHEN debet IS NULL THEN 0 ELSE debet END + CASE WHEN kredit IS NULL 
                      THEN 0 ELSE kredit END + CASE WHEN nk_perusahaan IS NULL THEN 0 ELSE nk_perusahaan END + CASE WHEN nk_karyawan IS NULL 
                      THEN 0 ELSE nk_karyawan END + CASE WHEN nk IS NULL THEN 0 ELSE nk END) - (CASE WHEN potongan IS NULL 
                      THEN 0 ELSE potongan END + CASE WHEN nd IS NULL THEN 0 ELSE nd END) AS kasir, seri_kuitansi, flag_jurnal
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL) AND (seri_kuitansi IN ('RJ', 'AJ'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_kasir_rj_ver_v]");
    }
};
