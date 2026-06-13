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
        DB::statement("CREATE VIEW dbo.sum_nk_persh_v
AS
SELECT     TOP (100) PERCENT b.nama_perusahaan, a.kode_perusahaan, b.flag, a.flag_tagih, SUM(a.nk_perusahaan) AS jumlah_tagihan, SUM(a.materai) 
                      AS materai
FROM         dbo.tc_trans_kasir AS a INNER JOIN
                      dbo.tc_registrasi AS c ON c.no_registrasi = a.no_registrasi INNER JOIN
                      dbo.mt_perusahaan AS b ON b.kode_perusahaan = c.kode_perusahaan
WHERE     (a.nk_perusahaan > 0) AND (a.kd_inv_persh_tx IS NULL OR
                      a.kd_inv_persh_tx = 0) AND (b.flag = 0 OR
                      b.flag IS NULL) AND (a.status_batal IS NULL) AND (a.tgl_jam BETWEEN '2015-03-10 00:00:00' AND '2015-03-10 23:59:59') AND (a.seri_kuitansi = 'AI')
GROUP BY b.nama_perusahaan, a.kode_perusahaan, b.flag, a.flag_tagih
ORDER BY b.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_nk_persh_v]");
    }
};
