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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_tc_hasilpenunjang_foto3_v
AS
SELECT     dbo.pm_tc_hasilpenunjang.hasil, dbo.pm_tc_hasilpenunjang.keterangan, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_tc_hasilpenunjang_foto2_v.id, 
                      dbo.pm_tc_hasilpenunjang_foto2_v.foto, dbo.pm_tc_hasilpenunjang_foto2_v.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang_foto2_v.nomor, dbo.pm_tc_hasilpenunjang_foto2_v.ext, 
                      dbo.pm_tc_hasilpenunjang_foto2_v.dihapus_pada, dbo.pm_tc_hasilpenunjang_foto2_v.no_registrasi, dbo.pm_tc_hasilpenunjang_foto2_v.no_mr, 
                      dbo.pm_tc_hasilpenunjang_foto2_v.tgl_transaksi
FROM         dbo.pm_mt_standarhasil RIGHT OUTER JOIN
                      dbo.pm_tc_hasilpenunjang_foto2_v INNER JOIN
                      dbo.pm_tc_hasilpenunjang ON dbo.pm_tc_hasilpenunjang_foto2_v.kode_trans_pelayanan = dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan ON 
                      dbo.pm_mt_standarhasil.kode_mt_hasilpm = dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_tc_hasilpenunjang_foto3_v]");
    }
};
