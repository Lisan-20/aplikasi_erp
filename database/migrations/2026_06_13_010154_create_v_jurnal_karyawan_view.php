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
        DB::statement("CREATE OR ALTER VIEW dbo.v_jurnal_karyawan
AS
SELECT     kode_tc_trans_kasir, no_registrasi
FROM         dbo.tx_harian
WHERE     (YEAR(tx_tgl) = 2014) AND (kel_jurnal IN (1, 2)) AND (kode_perusahaan IN (93, 94, 95)) AND (acc_no = 1130101) AND (no_registrasi > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_karyawan]");
    }
};
