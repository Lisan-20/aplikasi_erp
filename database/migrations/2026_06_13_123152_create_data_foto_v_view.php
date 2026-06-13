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
        DB::statement("CREATE VIEW dbo.data_foto_v
AS
SELECT     MIN(id) AS id, foto, kode_trans_pelayanan
FROM         dbo.pm_tc_hasilpenunjang_foto
WHERE     (dihapus_pada IS NULL)
GROUP BY foto, kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_foto_v]");
    }
};
