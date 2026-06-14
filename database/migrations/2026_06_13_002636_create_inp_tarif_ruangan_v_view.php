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
        DB::statement("CREATE OR ALTER VIEW dbo.inp_tarif_ruangan_v
AS
SELECT     dbo.mt_ruangan.kode_bagian, dbo.mt_ruangan.kode_klas, dbo.mt_klas_detail.kode_klas_det, dbo.mt_bagian.nama_bagian
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_ruangan.kode_bagian INNER JOIN
                      dbo.mt_klas_detail ON dbo.mt_ruangan.kode_klas = dbo.mt_klas_detail.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [inp_tarif_ruangan_v]");
    }
};
