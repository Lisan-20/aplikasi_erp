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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_hand_over_MAX_v
AS
SELECT     MAX(no_urut) AS no_urut, no_registrasi, notes, tgl_jam
FROM         dbo.tc_hand_over_shift_detail
GROUP BY no_registrasi, notes, tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hand_over_MAX_v]");
    }
};
