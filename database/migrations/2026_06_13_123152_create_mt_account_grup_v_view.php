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
        DB::statement("CREATE VIEW dbo.mt_account_grup_v
AS
SELECT     dbo.mt_account.acc_no, dbo.mt_account.acc_nama, mt_account_1.acc_no AS kode_4, mt_account_1.acc_nama AS nama_4, mt_account_2.acc_no AS kode_3, mt_account_2.acc_nama AS nama_3, 
                      dbo.mt_account.kode_utama, dbo.mt_account.level_coa, dbo.mt_account.id_biaya
FROM         dbo.mt_account INNER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.mt_account.referensi = mt_account_1.acc_no INNER JOIN
                      dbo.mt_account AS mt_account_2 ON mt_account_1.referensi = mt_account_2.acc_no
WHERE     (dbo.mt_account.level_coa = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_account_grup_v]");
    }
};
