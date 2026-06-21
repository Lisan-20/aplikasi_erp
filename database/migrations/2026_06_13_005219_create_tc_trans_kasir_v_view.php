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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_trans_kasir_v
AS
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, tgl_jam, no_mr, no_registrasi, nk_perusahaan, kode_perusahaan, nama_pasien, kd_inv_persh_tx, flag_tagih, 
                      status_batal
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_kasir_v]");
    }
};
