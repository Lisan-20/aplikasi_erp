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
        DB::statement("CREATE OR ALTER VIEW dbo.v_ruangan_kelas_det_ri
AS
SELECT     dbo.mt_klas.nama_klas, dbo.ri_tc_riwayat_kelas.no_mr, dbo.ri_tc_riwayat_kelas.no_registrasi, dbo.mt_ruangan.no_kamar, dbo.mt_ruangan.no_bed, 
                      dbo.mt_ruangan.kode_ruangan, dbo.ri_tc_riwayat_kelas.kode_riw_klas, dbo.mt_ruangan.kode_bagian
FROM         dbo.ri_tc_riwayat_kelas INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_riwayat_kelas.kelas_tujuan = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_ruangan ON dbo.ri_tc_riwayat_kelas.kode_ruangan = dbo.mt_ruangan.kode_ruangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_ruangan_kelas_det_ri]");
    }
};
