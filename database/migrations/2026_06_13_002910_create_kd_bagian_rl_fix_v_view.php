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
        DB::statement("CREATE OR ALTER VIEW dbo.kd_bagian_rl_fix_v
AS
SELECT     dbo.mt_bagian.nama_bagian, dbo.kd_bagian_rl_v.kode_bagian, dbo.mt_bagian.group_bag
FROM         dbo.mt_bagian INNER JOIN
                      dbo.kd_bagian_rl_v ON dbo.mt_bagian.kode_bagian = dbo.kd_bagian_rl_v.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kd_bagian_rl_fix_v]");
    }
};
