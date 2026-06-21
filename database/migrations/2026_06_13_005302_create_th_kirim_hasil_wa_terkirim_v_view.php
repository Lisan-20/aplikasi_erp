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
        DB::statement("CREATE OR ALTER VIEW dbo.th_kirim_hasil_wa_terkirim_v
AS
SELECT     no_mr, kode_tc_hasilpenunjang, kode_trans_pelayanan, kode_penunjang, kode_bagian, MAX(tgl_kirim) AS tgl_kirim, user_kirim, flag_wa, no_tlp
FROM         dbo.th_kirim_hasil_wa
GROUP BY no_mr, kode_tc_hasilpenunjang, kode_trans_pelayanan, kode_penunjang, kode_bagian, user_kirim, flag_wa, no_tlp
HAVING      (flag_wa = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_kirim_hasil_wa_terkirim_v]");
    }
};
