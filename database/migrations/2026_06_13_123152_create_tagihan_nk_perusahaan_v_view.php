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
        DB::statement("CREATE VIEW dbo.tagihan_nk_perusahaan_v
AS
SELECT     TOP (15) b.nama_perusahaan, a.kode_perusahaan, b.flag, a.flag_tagih, SUM(a.nk_perusahaan) AS jumlah_tagihan, SUM(a.materai) AS materai, 
                      a.seri_kuitansi, a.kd_inv_persh_tx, a.status_batal, a.tgl_jam, a.no_registrasi, a.no_mr, a.no_kuitansi
FROM         dbo.tc_trans_kasir AS a INNER JOIN
                      dbo.tc_registrasi AS c ON c.no_registrasi = a.no_registrasi INNER JOIN
                      dbo.mt_perusahaan AS b ON b.kode_perusahaan = c.kode_perusahaan
WHERE     (a.nk_perusahaan > 0) AND (a.kd_inv_persh_tx IS NULL OR
                      a.kd_inv_persh_tx = 0) AND (b.flag = 0 OR
                      b.flag IS NULL) AND (a.status_batal IS NULL) AND (a.status_batal IS NULL) AND (a.flag_tagih = 1)
GROUP BY b.nama_perusahaan, a.kode_perusahaan, b.flag, a.flag_tagih, a.seri_kuitansi, a.kd_inv_persh_tx, a.status_batal, a.tgl_jam, a.no_registrasi, a.no_mr, 
                      a.no_kuitansi
ORDER BY b.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_nk_perusahaan_v]");
    }
};
