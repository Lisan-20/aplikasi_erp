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
        DB::statement("CREATE VIEW dbo.dash_penerimaan_kasir_tgl_sum_v
AS
SELECT     dbo.dash_penerimaan_kasir_v.status_batal, SUM(dbo.dash_penerimaan_kasir_v.tunai) AS tunai, SUM(dbo.dash_penerimaan_kasir_v.debet) AS debet, 
                      SUM(dbo.dash_penerimaan_kasir_v.kredit) AS kredit, SUM(dbo.dash_penerimaan_kasir_v.nota_kredit) AS nota_kredit, 
                      SUM(dbo.dash_penerimaan_kasir_v.nota_debet) AS nota_debet, dbo.dash_penerimaan_kasir_v.kode_kelompok, dbo.mt_nasabah.nama_kelompok AS nasabah, 
                      YEAR(dbo.dash_penerimaan_kasir_v.tgl_jam) AS thn, MONTH(dbo.dash_penerimaan_kasir_v.tgl_jam) AS bln, DAY(dbo.dash_penerimaan_kasir_v.tgl_jam) 
                      AS tgl
FROM         dbo.dash_penerimaan_kasir_v INNER JOIN
                      dbo.mt_nasabah ON dbo.dash_penerimaan_kasir_v.kode_kelompok = dbo.mt_nasabah.kode_kelompok
GROUP BY dbo.dash_penerimaan_kasir_v.status_batal, dbo.dash_penerimaan_kasir_v.kode_kelompok, dbo.mt_nasabah.nama_kelompok, 
                      YEAR(dbo.dash_penerimaan_kasir_v.tgl_jam), MONTH(dbo.dash_penerimaan_kasir_v.tgl_jam), DAY(dbo.dash_penerimaan_kasir_v.tgl_jam)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_penerimaan_kasir_tgl_sum_v]");
    }
};
