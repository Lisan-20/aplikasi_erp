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
        DB::statement("CREATE VIEW dbo.fr_history_resep_v
AS
SELECT     dbo.fr_tc_pesan_resep.kode_pesan_resep, dbo.fr_tc_far_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, 
                      dbo.fr_tc_far_detail.jumlah_pesan, SUM(dbo.fr_tc_far_detail.jumlah_tebus) AS jumlah_tebus
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.fr_tc_pesan_resep ON dbo.fr_tc_far.kode_pesan_resep = dbo.fr_tc_pesan_resep.kode_pesan_resep INNER JOIN
                      dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.mt_barang.nama_brg, dbo.fr_tc_pesan_resep.kode_pesan_resep, dbo.mt_barang.satuan_kecil, dbo.fr_tc_far_detail.jumlah_pesan, 
                      dbo.fr_tc_far_detail.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_history_resep_v]");
    }
};
