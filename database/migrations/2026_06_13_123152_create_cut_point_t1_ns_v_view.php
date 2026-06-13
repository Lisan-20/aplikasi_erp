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
        DB::statement("CREATE VIEW dbo.cut_point_t1_ns_v
AS
SELECT     selisih_waktu, 5000 AS cut_point, npp, tgl_absensi
FROM         dbo.non_shift_absensi_v
WHERE     (selisih_waktu <= 15)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cut_point_t1_ns_v]");
    }
};
