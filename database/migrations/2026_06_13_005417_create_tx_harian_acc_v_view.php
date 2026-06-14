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
        DB::statement("CREATE OR ALTER VIEW dbo.tx_harian_acc_v
AS
SELECT     dbo.tx_harian.acc_no, dbo.tx_harian.tx_nominal, dbo.tx_harian.tx_uraian, dbo.tx_harian.tx_tipe, dbo.tx_harian.tx_tgl, dbo.tx_harian.no_bukti, 
                      dbo.mt_account.referensi, dbo.tx_harian.kode_bagian
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_harian_acc_v]");
    }
};
