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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_ri_max_v
AS
SELECT     MAX(kode_tc_periksa) AS Expr1, id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, ket, hasil, hasil2, no_urut_entry, kd_kk, no_registrasi, id_info, 
                      ket_hasil_bmi, no_mr, id_triase, sekor, kode_rm, no_urut_ews, no_urut, tgl_update
FROM         dbo.tc_pemeriksaan_ri
GROUP BY id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, ket, hasil, hasil2, no_urut_entry, kd_kk, no_registrasi, id_info, ket_hasil_bmi, no_mr, id_triase, 
                      sekor, kode_rm, no_urut_ews, no_urut, tgl_update
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_ri_max_v]");
    }
};
