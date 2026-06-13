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
        DB::statement("CREATE VIEW dbo.rekap_input_resep_v
AS
SELECT     SUM(dbo.fr_hisbebasluar_v.jumlah_tebus * dbo.fr_hisbebasluar_v.harga_jual) AS bill_total, dbo.tc_registrasi.kode_kelompok, DAY(dbo.fr_hisbebasluar_v.tgl_trans) 
                      AS tgl, MONTH(dbo.fr_hisbebasluar_v.tgl_trans) AS bln, YEAR(dbo.fr_hisbebasluar_v.tgl_trans) AS thn, dbo.fr_hisbebasluar_v.kode_profit, 
                      dbo.mt_nasabah.nama_kelompok
FROM         dbo.mt_nasabah INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_nasabah.kode_kelompok = dbo.tc_registrasi.kode_kelompok RIGHT OUTER JOIN
                      dbo.fr_hisbebasluar_v ON dbo.tc_registrasi.no_registrasi = dbo.fr_hisbebasluar_v.no_registrasi
GROUP BY dbo.tc_registrasi.kode_kelompok, DAY(dbo.fr_hisbebasluar_v.tgl_trans), MONTH(dbo.fr_hisbebasluar_v.tgl_trans), YEAR(dbo.fr_hisbebasluar_v.tgl_trans), 
                      dbo.fr_hisbebasluar_v.kode_profit, dbo.mt_nasabah.nama_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_input_resep_v]");
    }
};
