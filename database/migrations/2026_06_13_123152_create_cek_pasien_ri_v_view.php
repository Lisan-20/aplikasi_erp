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
        DB::statement("CREATE VIEW dbo.cek_pasien_ri_v
AS
SELECT DISTINCT 
                      dbo.tx_harian.no_registrasi, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tx_harian.tx_tgl, dbo.tc_trans_kasir.kode_tc_trans_kasir
FROM         dbo.tx_harian INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tx_harian.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tx_harian.kel_jurnal = 2) AND (dbo.tc_trans_kasir.seri_kuitansi = 'RI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pasien_ri_v]");
    }
};
