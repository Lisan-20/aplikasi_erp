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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_umum_v
AS
SELECT     nk AS jumlah_tagihan, no_mr, nama_pasien, no_kuitansi, seri_kuitansi, pembayar, no_registrasi, kode_tc_trans_kasir
FROM         dbo.tc_trans_kasir
WHERE     (kd_inv_umum_tx IS NULL) AND (tgl_jam BETWEEN '2013-4-21 00:00:00' AND '2014-4-21 23:59:59') AND (nk > 0) AND (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_umum_v]");
    }
};
