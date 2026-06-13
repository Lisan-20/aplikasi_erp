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
        DB::statement("CREATE VIEW dbo.rekap_kasir_sum_v
AS
SELECT     nama_pegawai, thn, bln, tgl, SUM(tunai) AS tunai, SUM(debet) AS debet, SUM(kredit) AS kredit, SUM(nk_karyawan) AS nk_karyawan, SUM(nk_perusahaan) AS nk_perusahaan, SUM(nk) AS nk, 
                      SUM(nd) AS nd, SUM(potongan) AS potongan
FROM         dbo.rekap_kasir_v
GROUP BY nama_pegawai, thn, bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_kasir_sum_v]");
    }
};
