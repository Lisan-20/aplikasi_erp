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
        DB::statement("CREATE VIEW dbo.mt_shift_v
AS
SELECT     kode_shift, nama_shift, dari_jam, sampai_jam, { fn HOUR(dari_jam) } AS jam
FROM         dbo.ks_mt_shift
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_shift_v]");
    }
};
