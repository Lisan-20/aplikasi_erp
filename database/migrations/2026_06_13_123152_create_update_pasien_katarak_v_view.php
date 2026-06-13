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
        DB::statement("CREATE OR ALTER VIEW dbo.update_pasien_katarak_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nik, dbo.pasien_katarak_2015.[NO BPJS]
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.pasien_katarak_2015 ON dbo.mt_master_pasien.no_mr = dbo.pasien_katarak_2015.[NO# MR]
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_pasien_katarak_v]");
    }
};
