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
        DB::statement("CREATE VIEW dbo.piutang_persh_d_v
AS
SELECT     acc_no, tx_nominal, tx_tgl, tx_tipe, referensi, tx_uraian, kode_perusahaan, no_bukti, tgl_tempo
FROM         dbo.tx_harian
WHERE     (acc_no = 1130108) AND (tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [piutang_persh_d_v]");
    }
};
