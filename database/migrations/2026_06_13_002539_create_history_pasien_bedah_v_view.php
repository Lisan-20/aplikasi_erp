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
        DB::statement("CREATE OR ALTER VIEW dbo.history_pasien_bedah_v
AS
SELECT     a.kode_tc_trans_kasir, a.no_mr, a.kode_kelompok, a.kode_perusahaan, a.kode_bagian, a.kode_klas, b.nama_bagian, c.nama_pasien, dbo.ri_tc_rawatinap.kode_ri, 
                      a.status_selesai
FROM         dbo.tc_trans_pelayanan AS a INNER JOIN
                      dbo.mt_bagian AS b ON a.kode_bagian = b.kode_bagian INNER JOIN
                      dbo.mt_master_pasien AS c ON a.no_mr = c.no_mr INNER JOIN
                      dbo.ri_tc_rawatinap ON a.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan
GROUP BY a.kode_tc_trans_kasir, a.no_mr, a.kode_kelompok, a.kode_perusahaan, a.kode_bagian, a.kode_klas, b.nama_bagian, c.nama_pasien, dbo.ri_tc_rawatinap.kode_ri, 
                      a.status_selesai
HAVING      (a.kode_bagian LIKE '0309%') AND (a.status_selesai > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [history_pasien_bedah_v]");
    }
};
