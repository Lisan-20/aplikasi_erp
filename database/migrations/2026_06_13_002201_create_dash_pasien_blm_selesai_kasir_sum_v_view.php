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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_pasien_blm_selesai_kasir_sum_v
AS
SELECT     SUM(dbo.dash_pasien_blm_selesai_kasir_v.RS + dbo.dash_pasien_blm_selesai_kasir_v.DR1) AS Billing, 
                      YEAR(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk) AS thn, MONTH(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk) AS bln, 
                      DAY(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk) AS tgl, dbo.mt_bagian.nama_bagian, dbo.dash_pasien_blm_selesai_kasir_v.kode_bagian_masuk
FROM         dbo.dash_pasien_blm_selesai_kasir_v INNER JOIN
                      dbo.mt_bagian ON dbo.dash_pasien_blm_selesai_kasir_v.kode_bagian_masuk = dbo.mt_bagian.kode_bagian
GROUP BY YEAR(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk), MONTH(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk), 
                      DAY(dbo.dash_pasien_blm_selesai_kasir_v.tgl_jam_masuk), dbo.mt_bagian.nama_bagian, dbo.dash_pasien_blm_selesai_kasir_v.kode_bagian_masuk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_pasien_blm_selesai_kasir_sum_v]");
    }
};
