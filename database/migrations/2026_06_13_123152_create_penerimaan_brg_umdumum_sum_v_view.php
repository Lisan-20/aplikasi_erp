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
        DB::statement("CREATE OR ALTER VIEW dbo.penerimaan_brg_umdumum_sum_v
AS
SELECT     no_bukti, tgl_transaksi, id_trans_umd, kode_supplier, namasupplier, kode_permohonan, SUM(jumlah_besar) AS jumlah_besar, SUM(ISNULL(jumlah_kirim, 0)) AS jumlah_kirim
FROM         dbo.penerimaan_barang_umdumum_v
GROUP BY no_bukti, tgl_transaksi, id_trans_umd, kode_supplier, namasupplier, kode_permohonan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_umdumum_sum_v]");
    }
};
