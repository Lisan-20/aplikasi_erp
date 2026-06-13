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
        DB::statement("CREATE VIEW dbo.update_amprah_hd_v
AS
SELECT     TOP (100) PERCENT dbo.tc_bpako_hemodialisa.kode_brg, dbo.tc_bpako_hemodialisa.nama_brg, dbo.tc_bpako_hemodialisa.jumlah, 
                      dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.kode_bagian, dbo.tc_bpako_hemodialisa.flag_amprah, 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS tahun, dbo.mt_barang.satuan_kecil, dbo.tc_bpako_hemodialisa.id_tc_permintaan_inst, 
                      dbo.tc_bpako_hemodialisa.kode_brg AS kode_barang
FROM         dbo.tc_bpako_hemodialisa INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_bpako_hemodialisa.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan INNER JOIN
                      dbo.mt_depo_stok ON dbo.tc_bpako_hemodialisa.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.mt_barang ON dbo.tc_bpako_hemodialisa.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.mt_depo_stok.kode_bagian = '050401') AND (YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) >= 2015)
ORDER BY dbo.tc_bpako_hemodialisa.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_amprah_hd_v]");
    }
};
