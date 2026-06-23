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



CREATE OR ALTER VIEW dbo.tc_po_nm_detail_v
AS
SELECT     dbo.tc_po_nm.no_po, dbo.tc_po_nm.tgl_po, dbo.tc_po_nm_det.kode_brg, dbo.mt_barang_jasa.nama_brg, dbo.tc_po_nm_det.jumlah_besar, dbo.tc_po_nm_det.content, 
                      dbo.tc_po_nm_det.harga_satuan, dbo.tc_po_nm_det.jumlah_harga, dbo.tc_po_nm_det.discount, dbo.tc_po_nm_det.bonus_besar, dbo.tc_po_nm_det.bonus_kecil, 
                      dbo.tc_po_nm_det.discount_rp, dbo.tc_po_nm_det.discount_psn, dbo.tc_po_nm_det.status_batal, dbo.tc_po_nm_det.status_close, dbo.tc_po_nm.id_tc_po, 
                      dbo.mt_barang_jasa.satuan_besar, dbo.tc_po_nm_det.id_tc_po_det
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det.id_tc_po INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_po_nm_det.kode_brg = dbo.mt_barang_jasa.kode_brg




");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_po_nm_detail_v]");
    }
};
