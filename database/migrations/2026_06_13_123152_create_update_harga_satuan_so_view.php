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
        DB::statement("CREATE VIEW dbo.update_harga_satuan_so
AS
SELECT     dbo.tbl_detail_so.id_tbl_det_so, dbo.tbl_detail_so.kode_brg, dbo.tbl_detail_so.satuan_kecil, dbo.tbl_detail_so.satuan_besar, dbo.tbl_detail_so.stok_sistem, 
                      dbo.tbl_detail_so.so, dbo.tbl_detail_so.kode_bagian, dbo.tbl_detail_so.tgl_input, dbo.tbl_detail_so.harga_satuan, dbo.mt_rekap_stok_v.harga_beli
FROM         dbo.tbl_detail_so INNER JOIN
                      dbo.mt_rekap_stok_v ON dbo.tbl_detail_so.kode_brg = dbo.mt_rekap_stok_v.kode_brg AND dbo.tbl_detail_so.harga_satuan <> dbo.mt_rekap_stok_v.harga_beli
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_harga_satuan_so]");
    }
};
