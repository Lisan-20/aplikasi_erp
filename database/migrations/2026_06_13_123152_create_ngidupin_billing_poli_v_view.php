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
        DB::statement("CREATE VIEW dbo.ngidupin_billing_poli_v
AS
SELECT     dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.status_periksa, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_keluar, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ngidupin_billing_poli_v]");
    }
};
