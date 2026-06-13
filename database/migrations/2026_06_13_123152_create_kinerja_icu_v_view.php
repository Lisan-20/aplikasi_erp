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
        DB::statement("CREATE VIEW dbo.kinerja_icu_v
AS
SELECT     kode_riw_klas, kode_ri, kode_kunjungan, no_registrasi, no_mr, kode_kelompok, kode_perusahaan, kode_dokter, kode_ruangan, bagian_tujuan, kelas_tujuan, 
                      no_kamar_tujuan, no_bed_tujuan, bagian_asal, kelas_asal, no_kamar_asal, no_bed_asal, harga, tgl_masuk, tgl_pindah, ket_masuk, ket_pindah, ket_keluar, 
                      status_hidup, kode_kematian, waktu_kematian
FROM         dbo.ri_tc_riwayat_kelas
WHERE     (ket_keluar > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kinerja_icu_v]");
    }
};
