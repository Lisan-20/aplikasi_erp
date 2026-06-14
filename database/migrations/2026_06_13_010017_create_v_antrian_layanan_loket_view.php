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
        DB::statement("CREATE OR ALTER VIEW dbo.v_antrian_layanan_loket
AS
SELECT     no_antrian, kode_bagian, no_antrian AS Expr1, tgl_antrian, no_urut
FROM         dbo.tc_antrian_loket
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_antrian_layanan_loket]");
    }
};
