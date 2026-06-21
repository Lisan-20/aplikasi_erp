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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_pasien_jamkesmas_v
AS
SELECT     TOP (100) PERCENT MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, YEAR(dbo.tc_trans_kasir.tgl_jam) AS tahun, COUNT(dbo.tc_trans_pelayanan.no_registrasi) 
                      AS jumlah_pasien
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_registrasi.kode_kelompok = 7) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.kode_bagian NOT LIKE '03%')
GROUP BY MONTH(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam)
ORDER BY bulan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_pasien_jamkesmas_v]");
    }
};
