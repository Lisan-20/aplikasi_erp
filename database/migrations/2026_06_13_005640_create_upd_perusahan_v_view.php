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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_perusahan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.kode_kelompok, dbo.pasprsh.NOPEG, dbo.pasprsh.PRSH, dbo.pasprsh.JENIS, dbo.pasprsh.PRSH1
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.pasprsh ON dbo.mt_master_pasien.no_mr = dbo.pasprsh.MR
WHERE     (dbo.mt_master_pasien.kode_kelompok = 1) AND (dbo.pasprsh.PRSH LIKE N'%allians%')
ORDER BY dbo.pasprsh.PRSH
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_perusahan_v]");
    }
};
