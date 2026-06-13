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
        DB::statement("CREATE VIEW dbo.lap_obat_pernasabah_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.kode_barang, dbo.mt_barang.nama_brg, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.mt_barang INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.mt_barang.kode_brg = dbo.fr_tc_far_detail.kode_brg INNER JOIN
                      dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir ON 
                      dbo.mt_barang.kode_brg = dbo.tc_trans_pelayanan.kode_barang AND dbo.fr_tc_far_detail.kd_tr_resep = dbo.tc_trans_pelayanan.kd_tr_resep
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan IN (11)) AND (dbo.tc_trans_pelayanan.kode_barang <> 'D38A0186') AND 
                      (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_obat_pernasabah_v]");
    }
};
