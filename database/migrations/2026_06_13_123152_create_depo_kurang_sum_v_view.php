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
        DB::statement("CREATE VIEW dbo.depo_kurang_sum_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, dbo.depo_kurang_v.kode_bagian, dbo.depo_kurang_v.kode_brg
FROM         dbo.mt_bagian INNER JOIN
                      dbo.depo_kurang_v ON dbo.mt_bagian.kode_bagian = dbo.depo_kurang_v.kode_bagian
GROUP BY dbo.mt_bagian.nama_bagian, dbo.depo_kurang_v.kode_bagian, dbo.depo_kurang_v.kode_brg
ORDER BY dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [depo_kurang_sum_v]");
    }
};
