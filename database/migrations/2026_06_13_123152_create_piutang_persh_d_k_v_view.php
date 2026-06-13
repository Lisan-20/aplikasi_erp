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
        DB::statement("CREATE VIEW dbo.piutang_persh_d_k_v
AS
SELECT     TOP (100) PERCENT dbo.piutang_persh_d_v.acc_no, dbo.piutang_persh_d_v.tx_nominal, dbo.piutang_persh_d_v.tx_tgl, dbo.piutang_persh_d_v.tx_tipe, 
                      dbo.piutang_persh_d_v.referensi, dbo.piutang_persh_d_v.tx_uraian, dbo.piutang_persh_d_v.kode_perusahaan, dbo.piutang_persh_d_v.no_bukti, 
                      dbo.piutang_persh_k_v.tx_nominal AS tx_nominal_lunas, dbo.piutang_persh_k_v.tx_tgl AS tx_tgl_lunas, dbo.piutang_persh_k_v.tx_tipe AS tx_tipe_pelunasan, 
                      dbo.piutang_persh_k_v.no_bukti AS no_bukti_pelunasan, dbo.mt_perusahaan.nama_perusahaan, dbo.piutang_persh_d_v.tgl_tempo, 
                      dbo.saldo_awal_piutang.saldo_awal
FROM         dbo.saldo_awal_piutang INNER JOIN
                      dbo.mt_perusahaan ON dbo.saldo_awal_piutang.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan LEFT OUTER JOIN
                      dbo.piutang_persh_d_v ON dbo.mt_perusahaan.kode_perusahaan = dbo.piutang_persh_d_v.kode_perusahaan LEFT OUTER JOIN
                      dbo.piutang_persh_k_v ON dbo.piutang_persh_d_v.kode_perusahaan = dbo.piutang_persh_k_v.kode_perusahaan AND 
                      dbo.piutang_persh_d_v.referensi = dbo.piutang_persh_k_v.referensi AND dbo.piutang_persh_d_v.acc_no = dbo.piutang_persh_k_v.acc_no
WHERE     (YEAR(dbo.piutang_persh_k_v.tx_tgl) IS NULL) OR
                      (YEAR(dbo.piutang_persh_k_v.tx_tgl) = 2014) AND (YEAR(dbo.piutang_persh_d_v.tx_tgl) = 2013)
ORDER BY dbo.piutang_persh_d_v.referensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [piutang_persh_d_k_v]");
    }
};
