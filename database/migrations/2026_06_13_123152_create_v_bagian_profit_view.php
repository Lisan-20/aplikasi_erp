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
        DB::statement("CREATE OR ALTER VIEW dbo.v_bagian_profit
AS
SELECT     dbo.mt_bagian.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.status_aktif, dbo.v_group_bagian.kd_bag_unit
FROM         dbo.v_group_bagian INNER JOIN
                      dbo.mt_bagian ON dbo.v_group_bagian.kd_bag_unit = dbo.mt_bagian.validasi
WHERE     (dbo.mt_bagian.status_aktif = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bagian_profit]");
    }
};
