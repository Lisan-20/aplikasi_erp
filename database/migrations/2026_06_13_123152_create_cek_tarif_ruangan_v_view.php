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
        DB::statement("CREATE VIEW dbo.cek_tarif_ruangan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, dbo.mt_master_tarif_ruangan.kode_bagian, dbo.mt_master_tarif_ruangan.kode_klas, 
                      dbo.mt_master_tarif_ruangan.harga_r, dbo.mt_master_tarif_ruangan.jumlah_k, dbo.mt_master_tarif_ruangan.jumlah_tt
FROM         dbo.mt_master_tarif_ruangan INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_master_tarif_ruangan.kode_bagian = dbo.mt_ruangan.kode_bagian AND 
                      dbo.mt_master_tarif_ruangan.kode_klas = dbo.mt_ruangan.kode_klas INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif_ruangan.kode_bagian = dbo.mt_bagian.kode_bagian
ORDER BY dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_tarif_ruangan_v]");
    }
};
