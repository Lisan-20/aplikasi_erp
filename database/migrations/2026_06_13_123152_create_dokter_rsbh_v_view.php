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
        DB::statement("CREATE OR ALTER VIEW dbo.dokter_rsbh_v
AS
SELECT     UPPER(nama_dokter) AS nama_dokter, specialist
FROM         dbo.master_dokter_rsbh
GROUP BY UPPER(nama_dokter), specialist
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dokter_rsbh_v]");
    }
};
