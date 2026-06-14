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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kasir_transaksi_umum_v
AS
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, tgl_jam, tunai, debet, tunai + debet AS jml_tu, uraian, kd_trans_bendahara, status_batal, acc_no AS acc_kredit, 
                      tgl_ver, flag_jurnal, kode_bagian, kode_perusahaan, no_mr, no_induk, no_registrasi
FROM         dbo.tc_trans_kasir
WHERE     (seri_kuitansi LIKE '%TU%') AND (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kasir_transaksi_umum_v]");
    }
};
