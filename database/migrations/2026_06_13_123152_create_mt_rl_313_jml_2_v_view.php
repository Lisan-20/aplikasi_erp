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
        DB::statement("CREATE VIEW dbo.mt_rl_313_jml_2_v
AS
SELECT     COUNT(kode_brg) AS jumlah, nama_brg, kode_golongan, kode_sub_golongan, nama_golongan, kode_brg
FROM         dbo.mt_rl_313_jml_v
GROUP BY nama_brg, kode_golongan, kode_sub_golongan, nama_golongan, kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_rl_313_jml_2_v]");
    }
};
