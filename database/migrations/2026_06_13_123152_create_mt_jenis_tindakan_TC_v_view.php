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
        DB::statement("CREATE VIEW dbo.mt_jenis_tindakan_TC_v
AS
SELECT     dbo.mt_jenis_tc_det_tarif.nomer_tind, dbo.mt_jenis_TC_det.nama_tindakan, dbo.mt_jenis_tc_det_tarif.no, dbo.mt_jenis_TC.nama_jenis, 
                      dbo.mt_jenis_tc_det_tarif.penggunaan, dbo.mt_jenis_tc_det_tarif.harga, dbo.mt_jenis_TC_det.satuan, dbo.mt_jenis_TC_det.kode_bagian
FROM         dbo.mt_jenis_tc_det_tarif INNER JOIN
                      dbo.mt_jenis_TC_det ON dbo.mt_jenis_tc_det_tarif.nomer_tind = dbo.mt_jenis_TC_det.nomer_tind INNER JOIN
                      dbo.mt_jenis_TC ON dbo.mt_jenis_tc_det_tarif.no = dbo.mt_jenis_TC.no
WHERE     (dbo.mt_jenis_tc_det_tarif.harga > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_jenis_tindakan_TC_v]");
    }
};
