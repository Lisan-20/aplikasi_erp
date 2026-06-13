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
        DB::statement("CREATE VIEW dbo.update_spasi_brg_v
AS
SELECT     RTRIM(nama_brg) AS nama_brg_upd, nama_brg
FROM         dbo.mt_barang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_spasi_brg_v]");
    }
};
