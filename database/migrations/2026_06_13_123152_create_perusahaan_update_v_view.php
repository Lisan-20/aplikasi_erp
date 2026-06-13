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
        DB::statement("CREATE VIEW dbo.perusahaan_update_v
AS
SELECT     dbo.prsh.P_NAMA, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_perusahaan.kode_perusahaan, dbo.prsh.P_ADM, dbo.prsh.P_ALM, dbo.prsh.P_TELP, dbo.prsh.P_KODE
FROM         dbo.prsh LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.prsh.P_NAMA = dbo.mt_perusahaan.nama_perusahaan
GROUP BY dbo.prsh.P_NAMA, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_perusahaan.kode_perusahaan, dbo.prsh.P_ADM, dbo.prsh.P_ALM, dbo.prsh.P_TELP, dbo.prsh.P_KODE
HAVING      (dbo.mt_perusahaan.nama_perusahaan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [perusahaan_update_v]");
    }
};
