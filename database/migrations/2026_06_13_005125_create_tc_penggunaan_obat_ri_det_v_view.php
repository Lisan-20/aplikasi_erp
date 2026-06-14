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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_penggunaan_obat_ri_det_v
AS
SELECT     dbo.tc_penggunaan_obat_ri_det.id_penggunaan_det, dbo.tc_penggunaan_obat_ri_det.kode_brg, dbo.tc_penggunaan_obat_ri_det.nama_brg, dbo.tc_penggunaan_obat_ri_det.jumlah, 
                      dbo.tc_penggunaan_obat_ri_det.kd_tr_resep, dbo.tc_penggunaan_obat_ri_det.kode_trans_far, dbo.tc_penggunaan_obat_ri_det.waktu_pemakaian, dbo.tc_penggunaan_obat_ri_det.id_penggunaan, 
                      dbo.tc_penggunaan_obat_ri_det.intruksi, dbo.tc_penggunaan_obat_ri_det.int_penggunaan, dbo.tc_penggunaan_obat_ri_det.int_waktu_pakai, dbo.mt_barang.satuan_kecil
FROM         dbo.tc_penggunaan_obat_ri_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_penggunaan_obat_ri_det.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penggunaan_obat_ri_det_v]");
    }
};
