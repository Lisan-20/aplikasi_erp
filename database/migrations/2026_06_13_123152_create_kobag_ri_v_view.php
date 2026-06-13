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
        DB::statement("CREATE VIEW dbo.kobag_ri_v
AS
SELECT     kode_tc_trans_kasir, kode_bagian_asal
FROM         dbo.tc_trans_pelayanan
WHERE     (status_selesai = 3) AND (kode_tc_trans_kasir IS NOT NULL) AND (jenis_tindakan = 13)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kobag_ri_v]");
    }
};
