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
        DB::statement("CREATE VIEW dbo.dash_penerimaan_kasir_user_tgl_sum_v
AS
SELECT     status_batal, SUM(tunai) AS tunai, SUM(debet) AS debet, SUM(kredit) AS kredit, SUM(nota_kredit) AS nota_kredit, SUM(nota_debet) AS nota_debet, YEAR(tgl_jam) 
                      AS thn, MONTH(tgl_jam) AS bln, DAY(tgl_jam) AS tgl, no_induk, nama_pegawai
FROM         dbo.dash_penerimaan_kasir_user_v
GROUP BY status_batal, YEAR(tgl_jam), MONTH(tgl_jam), DAY(tgl_jam), no_induk, nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_penerimaan_kasir_user_tgl_sum_v]");
    }
};
