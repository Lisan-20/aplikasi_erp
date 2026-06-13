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
        DB::statement("CREATE VIEW dbo.upd_mt_bagian
AS
SELECT     nama_bagian, status_aktif, kode_bagian, group_bag
FROM         dbo.mt_bagian
WHERE     (NOT (kode_bagian IN ('010101', '010701', '010801', '011001', '011101', '012201', '010301')) AND kode_bagian LIKE '01%') AND (group_bag = 'detail')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_mt_bagian]");
    }
};
