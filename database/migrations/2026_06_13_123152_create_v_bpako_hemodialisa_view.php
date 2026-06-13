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
        DB::statement("CREATE VIEW dbo.v_bpako_hemodialisa
AS
SELECT     dbo.tc_bpako_hemodialisa.kode_brg, dbo.tc_bpako_hemodialisa.nama_brg, dbo.tc_trans_kasir.tgl_jam AS tgl_transaksi, 
                      dbo.tc_bpako_hemodialisa.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, 
                      SUM(dbo.tc_bpako_hemodialisa.jumlah) AS jumlah, dbo.tc_trans_pelayanan.no_kunjungan
FROM         dbo.tc_bpako_hemodialisa INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_bpako_hemodialisa.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan AND 
                      dbo.tc_bpako_hemodialisa.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_bpako_hemodialisa.kode_brg, dbo.tc_bpako_hemodialisa.nama_brg, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_bpako_hemodialisa.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_trans_pelayanan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bpako_hemodialisa]");
    }
};
