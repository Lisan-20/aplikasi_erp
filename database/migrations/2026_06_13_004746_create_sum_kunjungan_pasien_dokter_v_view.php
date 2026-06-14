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
        DB::statement("CREATE OR ALTER VIEW dbo.sum_kunjungan_pasien_dokter_v
AS
SELECT     TOP (100) PERCENT dbo.kunjungan_pasien_baru_v.bln, dbo.kunjungan_pasien_lama_v.thn, dbo.kunjungan_pasien_baru_v.kode_bagian_tujuan, 
                      dbo.kunjungan_pasien_baru_v.kode_kelompok, SUM(dbo.kunjungan_pasien_lama_v.jml_pasien) AS lama, SUM(dbo.kunjungan_pasien_baru_v.jml_pasien) AS baru, 
                      dbo.kunjungan_pasien_lama_v.perusahaan, dbo.kunjungan_pasien_lama_v.kode_dokter
FROM         dbo.kunjungan_pasien_baru_v INNER JOIN
                      dbo.kunjungan_pasien_lama_v ON dbo.kunjungan_pasien_baru_v.bln = dbo.kunjungan_pasien_lama_v.bln AND 
                      dbo.kunjungan_pasien_baru_v.thn = dbo.kunjungan_pasien_lama_v.thn AND 
                      dbo.kunjungan_pasien_baru_v.kode_bagian_tujuan = dbo.kunjungan_pasien_lama_v.kode_bagian_tujuan AND 
                      dbo.kunjungan_pasien_baru_v.perusahaan = dbo.kunjungan_pasien_lama_v.perusahaan AND 
                      dbo.kunjungan_pasien_baru_v.kode_dokter = dbo.kunjungan_pasien_lama_v.kode_dokter
GROUP BY dbo.kunjungan_pasien_baru_v.bln, dbo.kunjungan_pasien_lama_v.thn, dbo.kunjungan_pasien_baru_v.kode_bagian_tujuan, 
                      dbo.kunjungan_pasien_baru_v.kode_kelompok, dbo.kunjungan_pasien_lama_v.perusahaan, dbo.kunjungan_pasien_lama_v.kode_dokter
HAVING      (dbo.kunjungan_pasien_baru_v.kode_bagian_tujuan <> '')
ORDER BY dbo.kunjungan_pasien_baru_v.bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_kunjungan_pasien_dokter_v]");
    }
};
