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
        DB::statement("



CREATE OR ALTER VIEW dbo.penerimaan_brg_nm_v
AS
SELECT     dbo.tc_penerimaan_barang_nm.no_po, dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim
FROM         dbo.tc_penerimaan_barang_nm INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.tc_penerimaan_barang_nm.kode_penerimaan = dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_nm_v]");
    }
};
