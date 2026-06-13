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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_tc_hasilpenunjang_foto2_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.pm_tc_hasilpenunjang_foto.id, dbo.pm_tc_hasilpenunjang_foto.nama, dbo.pm_tc_hasilpenunjang_foto.foto, dbo.pm_tc_hasilpenunjang_foto.dibuat_pada, 
                      dbo.pm_tc_hasilpenunjang_foto.dibuat_oleh, dbo.pm_tc_hasilpenunjang_foto.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang_foto.nomor, dbo.pm_tc_hasilpenunjang_foto.ext, 
                      dbo.pm_tc_hasilpenunjang_foto.dihapus_pada, dbo.pm_tc_hasilpenunjang_foto.dihapus_oleh, dbo.pm_tc_hasilpenunjang_foto.no_mr, dbo.pm_tc_hasilpenunjang_foto.kode_penunjang, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.pm_tc_hasilpenunjang_foto INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_hasilpenunjang_foto.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_tc_hasilpenunjang_foto2_v]");
    }
};
