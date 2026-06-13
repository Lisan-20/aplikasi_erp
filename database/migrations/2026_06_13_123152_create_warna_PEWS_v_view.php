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
        DB::statement("CREATE VIEW dbo.warna_PEWS_v
AS
SELECT     sekor, warna
FROM         dbo.mt_acc_erm
WHERE     (kd_periksa >= 73000) AND (kd_periksa < 74000) AND (warna IS NOT NULL)
GROUP BY sekor, warna
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [warna_PEWS_v]");
    }
};
