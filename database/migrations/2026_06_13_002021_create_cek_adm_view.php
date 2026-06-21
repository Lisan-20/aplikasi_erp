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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_adm
AS
SELECT     acc_no, tx_nominal, tx_uraian, MONTH(tx_tgl) AS bulan, YEAR(tx_tgl) AS tahun, tx_jam, tx_tipe, no_bukti, SUBSTRING(kode_bagian, 1, 2) AS kobag, kel_jurnal, no_mr, 
                      no_registrasi, kode_tc_trans_kasir
FROM         dbo.tx_harian
WHERE     (acc_no = 3160101) AND (kel_jurnal IN (1, 2)) AND (tx_nominal > 500) AND (no_registrasi = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_adm]");
    }
};
