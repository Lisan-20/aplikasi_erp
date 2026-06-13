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
        DB::statement("CREATE OR ALTER VIEW dbo.bpako_hemo_v
AS
SELECT     dbo.tc_bpako_hemodialisa.no_kunjungan, dbo.tc_bpako_hemodialisa.no_mr, dbo.tc_bpako_hemodialisa.no_registrasi, 
                      dbo.tc_bpako_hemodialisa.kode_brg, dbo.tc_bpako_hemodialisa.nama_brg, dbo.tc_bpako_hemodialisa.jumlah, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_bpako_hemodialisa.kode_trans_pelayanan, DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.nama_tindakan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi RIGHT OUTER JOIN
                      dbo.tc_bpako_hemodialisa ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.tc_bpako_hemodialisa.kode_trans_pelayanan AND 
                      dbo.tc_registrasi.no_registrasi = dbo.tc_bpako_hemodialisa.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bpako_hemo_v]");
    }
};
