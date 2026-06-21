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
        DB::statement("CREATE OR ALTER VIEW dbo.rawat_inap_v
AS
SELECT     kode_bagian, nama_bagian
FROM         dbo.mt_bagian
WHERE     (kode_bagian IN (030101, 030102, 030103, 030105, 030106, 030109, 030111, 030112, 030113, 030114, 030115, 030116, 030117, 030118, 030119, 030120, 030121, 030122, 030123, 030124, 
                      030125, 030126, 030127, 030128, 030129))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rawat_inap_v]");
    }
};
