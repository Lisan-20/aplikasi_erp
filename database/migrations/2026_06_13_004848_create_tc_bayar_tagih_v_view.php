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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_bayar_tagih_v
AS
SELECT     id_tc_tagih, SUM(jumlah_bayar) AS jumlah_bayar, SUM(diskon) AS diskon, SUM(biaya_transfer) AS biaya_transfer, SUM(pajak) AS pajak, 
                      SUM(tagihan_tidak_dicover) AS tagihan_tidak_dicover
FROM         dbo.tc_bayar_tagih
GROUP BY id_tc_tagih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_bayar_tagih_v]");
    }
};
