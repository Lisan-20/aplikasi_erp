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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_status_batal_pelayanan
AS
SELECT     TOP (100) PERCENT dbo.pelayanan_backup.status_batal, dbo.pelayanan_live.status_batal AS batal_live
FROM         dbo.pelayanan_backup INNER JOIN
                      dbo.pelayanan_live ON dbo.pelayanan_backup.kode_trans_pelayanan = dbo.pelayanan_live.kode_trans_pelayanan
WHERE     (dbo.pelayanan_backup.status_batal = 1)
ORDER BY dbo.pelayanan_backup.status_batal DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_status_batal_pelayanan]");
    }
};
