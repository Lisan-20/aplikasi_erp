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
        DB::statement("CREATE VIEW dbo.v_hutang_uang_muka_D
AS
SELECT     no_urut, acc_no, tx_nominal, tx_uraian, tx_tgl, tx_jam, tx_tipe, no_jurnal, no_det_jurnal, no_bukti, kode_bagian, no_induk, kel_jurnal, no_mr, no_registrasi, 
                      kode_tc_trans_kasir, referensi, kd_trans_bendahara, kd_group_trans
FROM         dbo.tx_harian
WHERE     (kel_jurnal = '2') AND (tx_tipe = 'D') AND (no_bukti LIKE 'UM%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_hutang_uang_muka_D]");
    }
};
