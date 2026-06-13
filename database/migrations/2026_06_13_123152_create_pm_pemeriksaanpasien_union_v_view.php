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
        DB::statement("CREATE VIEW dbo.pm_pemeriksaanpasien_union_v
AS
SELECT     no_mr, thn, bln, tgl, tgl_masuk, kode_bagian, kode_trans_pelayanan, kode_tc_trans_kasir, no_kunjungan, no_registrasi, nama_pasien, tgl_keluar, status_batal, kode_kelompok, 
                      kode_bagian_asal
FROM         pm_pemeriksaanpasien_v
UNION
SELECT     no_mr, thn, bln, tgl, tgl_masuk, kode_bagian, kode_trans_pelayanan, kode_tc_trans_kasir, no_kunjungan, no_registrasi, nama_pasien, tgl_keluar, status_batal, kode_kelompok, 
                      kode_bagian_asal
FROM         pm_pemeriksaanpasienluar_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaanpasien_union_v]");
    }
};
