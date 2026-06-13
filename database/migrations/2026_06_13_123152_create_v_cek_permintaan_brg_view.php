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
        DB::statement("CREATE VIEW dbo.v_cek_permintaan_brg
AS
SELECT     TOP (100) PERCENT dbo.tc_permohonan_det.kode_brg, dbo.tc_permohonan.kode_permohonan, dbo.tc_permohonan.id_tc_permohonan, 
                      dbo.tc_permohonan_det.status_batal, dbo.tc_permohonan_det.status_po, dbo.tc_permohonan_det.jumlah_besar, dbo.tc_permohonan_det.jumlah_besar_acc, 
                      dbo.mt_barang.nama_brg, dbo.mt_barang.kode_brg AS kode, dbo.tc_penerimaan_barang_detail.jumlah_kirim, dbo.tc_penerimaan_barang_detail.jumlah_pesan
FROM         dbo.tc_penerimaan_barang_detail INNER JOIN
                      dbo.tc_permohonan INNER JOIN
                      dbo.tc_permohonan_det ON dbo.tc_permohonan.id_tc_permohonan = dbo.tc_permohonan_det.id_tc_permohonan INNER JOIN
                      dbo.tc_po_det INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po ON dbo.tc_permohonan_det.id_tc_permohonan_det = dbo.tc_po_det.id_tc_permohonan_det ON 
                      dbo.tc_penerimaan_barang_detail.id_tc_po_det = dbo.tc_po_det.id_tc_po_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_permohonan_det.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_permohonan_det.status_batal = 0) AND (dbo.tc_permohonan_det.kode_brg IS NOT NULL) AND (dbo.tc_permohonan_det.kode_brg <> '') AND 
                      (dbo.tc_penerimaan_barang_detail.jumlah_kirim < dbo.tc_penerimaan_barang_detail.jumlah_pesan) OR
                      (dbo.tc_permohonan_det.status_batal IS NULL)
ORDER BY dbo.tc_permohonan.kode_permohonan DESC, dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_permintaan_brg]");
    }
};
