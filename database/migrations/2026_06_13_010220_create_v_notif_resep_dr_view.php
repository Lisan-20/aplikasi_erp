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
        DB::statement("CREATE OR ALTER VIEW dbo.v_notif_resep_dr
AS
SELECT     TOP (100) PERCENT a.flag_resep, a.nama_pasien, a.no_mr, a.kode_trans_far, a.kode_profit, a.status_transaksi, a.tgl_trans, a.kode_bagian_asal, a.no_registrasi, a.kode_dokter, 
                      COUNT(b.kd_tr_resep) AS cek, a.stat_dr
FROM         dbo.fr_tc_far AS a INNER JOIN
                      dbo.fr_tc_far_detail AS b ON a.kode_trans_far = b.kode_trans_far
WHERE     (a.flag_resep = 1) AND (a.kode_profit = 2000) AND (a.status_transaksi IS NULL)
GROUP BY a.flag_resep, a.nama_pasien, a.no_mr, a.kode_trans_far, a.kode_profit, a.status_transaksi, a.tgl_trans, a.kode_bagian_asal, a.no_registrasi, a.kode_dokter, a.stat_dr
HAVING      (a.stat_dr = 1)
ORDER BY a.tgl_trans DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_notif_resep_dr]");
    }
};
