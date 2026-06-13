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
        DB::statement("CREATE VIEW dbo.piutang_jt_tempo_v
AS
SELECT     dbo.tx_harian.acc_no, dbo.tx_harian.tx_tipe, dbo.tx_harian.tgl_tempo, dbo.mt_perusahaan.nama_perusahaan, dbo.tx_harian.tx_tgl, 
                      dbo.tx_harian.no_bukti, dbo.tx_harian.tx_nominal
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_perusahaan ON dbo.tx_harian.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.tx_harian.acc_no = 1130108) AND (dbo.tx_harian.tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [piutang_jt_tempo_v]");
    }
};
