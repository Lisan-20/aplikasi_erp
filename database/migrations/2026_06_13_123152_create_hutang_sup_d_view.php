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
        DB::statement("CREATE VIEW dbo.hutang_sup_d
AS
SELECT     acc_no, tx_nominal, tx_tgl, tx_tipe, referensi, tx_uraian, kode_supplier, no_bukti
FROM         dbo.tx_harian
WHERE     (acc_no = 2110101) AND (tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hutang_sup_d]");
    }
};
