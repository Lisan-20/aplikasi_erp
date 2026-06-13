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
        DB::statement("CREATE VIEW dbo.cara_bayar_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, COUNT(dbo.tc_trans_kasir.rl_bag) AS jml, 
                      dbo.tc_trans_kasir.rl_bag, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
GROUP BY YEAR(dbo.tc_trans_kasir.tgl_jam), MONTH(dbo.tc_trans_kasir.tgl_jam), dbo.tc_trans_kasir.rl_bag, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_trans_kasir.tgl_jam
HAVING      (dbo.tc_trans_kasir.rl_bag IS NOT NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cara_bayar_v]");
    }
};
