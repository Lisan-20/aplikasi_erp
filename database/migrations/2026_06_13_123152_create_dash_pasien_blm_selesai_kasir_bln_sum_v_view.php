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
        DB::statement("CREATE VIEW dbo.dash_pasien_blm_selesai_kasir_bln_sum_v
AS
SELECT     SUM(dbo.dash_pasien_blm_selesai_kasir_v.RS + dbo.dash_pasien_blm_selesai_kasir_v.DR1 + dbo.dash_pasien_blm_selesai_kasir_v.DR2) AS Billing, 
                      YEAR(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk) AS thn, MONTH(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk) AS bln, mt_bagian_1.nama_bagian, 
                      mt_bagian_1.kode_bagian
FROM         dbo.mt_bagian AS mt_bagian_1 INNER JOIN
                      dbo.mt_bagian ON mt_bagian_1.kode_bagian = dbo.mt_bagian.validasi INNER JOIN
                      dbo.dash_pasien_blm_selesai_kasir_v ON dbo.mt_bagian.kode_bagian = dbo.dash_pasien_blm_selesai_kasir_v.kode_bagian_keluar
GROUP BY YEAR(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk), MONTH(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk), mt_bagian_1.nama_bagian, mt_bagian_1.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_pasien_blm_selesai_kasir_bln_sum_v]");
    }
};
