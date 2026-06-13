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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_nk_umum
AS
SELECT     TOP (100) PERCENT b.nama_perusahaan, a.kode_penanggung AS kode_perusahaan, b.flag, a.flag_tagih, SUM(a.nk) AS jumlah_tagihan, 
                      SUM(a.materai) AS materai, a.kd_inv_umum_tx AS kd_inv_persh_tx, a.flag_tagih_penanggung
FROM         dbo.tc_trans_kasir AS a INNER JOIN
                      dbo.tc_registrasi AS c ON c.no_registrasi = a.no_registrasi INNER JOIN
                      dbo.mt_perusahaan AS b ON a.kode_penanggung = b.kode_perusahaan
WHERE     (a.status_batal IS NULL) AND (a.seri_kuitansi = 'AI') AND (a.nk > 0)
GROUP BY b.nama_perusahaan, a.kode_penanggung, b.flag, a.flag_tagih, a.kd_inv_umum_tx, a.flag_tagih_penanggung
HAVING      (a.flag_tagih_penanggung = 1)
ORDER BY b.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_nk_umum]");
    }
};
