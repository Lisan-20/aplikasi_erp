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
        DB::statement("CREATE VIEW dbo.rg_tc_rujukan_v
AS
SELECT     dbo.rg_tc_rujukan.kode_rujukan, dbo.rg_tc_rujukan.rujukan_dari, dbo.rg_tc_rujukan.no_mr, dbo.rg_tc_rujukan.no_kunjungan_lama, dbo.rg_tc_rujukan.no_registrasi, dbo.rg_tc_rujukan.status, 
                      dbo.rg_tc_rujukan.tgl_input, dbo.mt_ruangan.flag_aktif AS booking_ruangan, dbo.mt_ruangan.kode_ruangan, dbo.mt_ruangan.no_kamar, dbo.mt_ruangan.kode_klas, dbo.mt_ruangan.no_bed, 
                      dbo.mt_klas.nama_klas
FROM         dbo.mt_klas INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_klas.kode_klas = dbo.mt_ruangan.kode_klas RIGHT OUTER JOIN
                      dbo.rg_tc_rujukan ON dbo.mt_ruangan.flag_aktif = dbo.rg_tc_rujukan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_tc_rujukan_v]");
    }
};
