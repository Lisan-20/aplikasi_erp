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
        DB::statement("CREATE VIEW dbo.mt_depo_kurang_v
AS
SELECT     COUNT(kode_brg) AS jml_brg, nama_bagian, kode_bagian
FROM         dbo.mt_depo_stok_v_2
GROUP BY nama_bagian, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_kurang_v]");
    }
};
