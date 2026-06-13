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
        DB::statement("CREATE VIEW dbo.jml_penolakan_piut_man_v
AS
SELECT     id_bd_tc_trans, SUM(jumlah) AS penolakan, uraian
FROM         dbo.bd_tc_trans_detail
GROUP BY id_bd_tc_trans, uraian
HAVING      (uraian = 'Tagihan Tidak Dicover')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_penolakan_piut_man_v]");
    }
};
