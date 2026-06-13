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
        DB::statement("CREATE VIEW dbo.inp_tagihan_umum_det_v
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kd_inv_umum_tx, dbo.tc_tagih.jumlah_tagih, 
                      dbo.tc_tagih.nama_tertagih, dbo.tc_tagih.id_tc_tagih
FROM         dbo.tc_tagih INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_tagih.id_tc_tagih = dbo.tc_trans_kasir.kd_inv_umum_tx
WHERE     (dbo.tc_tagih.id_tc_tagih IN (84, 118, 119, 117, 366, 367, 373, 374, 375, 368, 459, 460, 461, 462, 464, 465, 481, 486, 487, 488, 482, 483, 484, 489, 490, 485, 535, 536, 
                      623, 625, 626, 537, 595, 627, 628, 645, 703, 704, 532, 533, 644, 647, 804, 805, 706, 794, 795, 796, 797, 837, 834, 633, 634, 635, 646, 665, 666, 677, 678, 685, 686, 
                      687, 700, 701, 702, 768, 769, 770, 771, 772, 773, 833, 835, 836))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [inp_tagihan_umum_det_v]");
    }
};
