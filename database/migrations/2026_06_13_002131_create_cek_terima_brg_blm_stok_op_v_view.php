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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_terima_brg_blm_stok_op_v
AS
SELECT DISTINCT dbo.cek_brg_gudang_blm_stok_opname_v.kode_brg, dbo.cek_brg_gudang_blm_stok_opname_v.nama_brg
FROM         dbo.cek_brg_gudang_blm_stok_opname_v INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.cek_brg_gudang_blm_stok_opname_v.kode_brg = dbo.tc_penerimaan_barang_detail.kode_brg
WHERE     (dbo.tc_penerimaan_barang_detail.jumlah_kirim > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_terima_brg_blm_stok_op_v]");
    }
};
