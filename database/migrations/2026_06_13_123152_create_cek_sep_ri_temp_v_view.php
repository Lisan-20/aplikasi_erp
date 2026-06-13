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
        DB::statement("CREATE VIEW dbo.cek_sep_ri_temp_v
AS
SELECT     COUNT(no_mr) AS Expr1, nama_pasien, jenis, MONTH(tgl_masuk) AS bln, no_mr
FROM         dbo.tc_sep_ri_temp
GROUP BY nama_pasien, jenis, MONTH(tgl_masuk), no_mr
HAVING      (jenis = 'RI') AND (COUNT(no_mr) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_sep_ri_temp_v]");
    }
};
